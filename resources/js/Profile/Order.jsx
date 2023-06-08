import React, {useState, useEffect} from 'react'
import axios from 'axios'
import Loader from '../Component/Loader';

const Order = () => {

  const [orderData, setOrderData] = useState({});
  const [order, setOrder] = useState([]);
  const [page, setPage] = useState(1);


  const [loader, setLoader] = useState(true);

  useEffect(() => {
    setLoader(true);

    axios.get('/api/order?page=' + page).then(res => {
      setOrderData(res.data);
      setOrder(res.data.data);
      setLoader(false);
    });
  },[page]);

  return (
    <div className='container mt-3'>

      {
        loader ? <Loader /> : (
          <>
                  <table className='table table-striped'>
        <tbody>
          {
            order.map(d => (
              <tr key={d.id}>
              <td>
                <img src={d.product.image_url} alt="" style={{width: 100, height: 100}} />
              </td>
              <td>{d.product.name}</td>
              <td>{d.total_quantity}</td>
              <td>{d.product.sale_price * d.total_quantity}</td>
              <td>
                {
                  d.status == 'pending' ? <span className='badge badge-warning'>Pending</span> : ''
                }
                {
                  d.status == 'success' ? <span className='badge badge-success'>Success</span> : ''

                }
                {
                  d.status == 'cancel' ? <span className='badge badge-danger'>Cancel</span> : ''

                }
              </td>
            </tr>
            ))
          }
        </tbody>
      </table>


      <button className='btn btn-dark btn-sm'
      disabled={orderData.prev_page_url == null ? true : false}
      onClick={()=>setPage(page - 1)}
      >Prev</button>

      <button className='btn btn-dark btn-sm'
      disabled = {orderData.next_page_url == null ? true: false}
      onClick={()=>setPage(page + 1)}
      >Next</button>

      <button className='btn btn-dark btn-sm'
      onClick={()=>setPage(orderData.last_page)}
      >Last</button>
          </>
        )
      }

    </div>
  )
}

export default Order