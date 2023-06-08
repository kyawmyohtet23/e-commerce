import axios from 'axios';
import React, {useEffect, useState} from 'react'
import Loader from '../Component/Loader';

// data from dashboard
const user = blade_user;

const Cart = () => {

  const [loader, setLoader] = useState(true); 
  const [cart, setCart] = useState([]);


  const [name, setName] = useState(user.name);
  const [email, setEmail] = useState(user.email);

  useEffect(() => {
    axios.get('/api/cart').then(res => {
      // console.log(res.data);
      setCart(res.data);
      setLoader(false);
    });
  }, [])


  const addQty = (id) => {
    axios.post('/api/add-cart', {id}).then(res => {
      if(res.data == 'success')
      {
        const newCart = cart.map(eachCart => {
          if(eachCart.id == id){
            eachCart.total_quantity += 1;
          }

          return eachCart;
          
        });
        setCart(newCart);
      }
    });
  }

  const subQty = (id) => {
    axios.post('/api/sub-cart', {id}).then(res => {
      if(res.data == 'sub_success')
      {
        const newCart = cart.map(eachCart => {
          if(eachCart.id == id){
            eachCart.total_quantity -= 1;
          }

          return eachCart;
          
        });
        setCart(newCart);
      }
    });
  }


  // check out
  const checkOut = () => {
    const data = new FormData();
    data.append('name', name);
    data.append('email', email);

    // console.log(data);
    axios.post('/api/checkout-cart', data).then(res => {
      console.log(res.data);
      if(res.data == 'check_out_fail'){
        errorCheckOut('No Cart Available');
        return;
      }
        if(res.data == 'check_out_success'){
          setCart([]);
          setName('');
          setEmail('');
          successCheckOut('Your Order has proceed');
        }


    });
  }

  return (
    
    <>
    {
      loader ? <Loader /> : (
        <>
                <table className='table mt-4 '>
        <tbody>
          
            {
              cart.map(c => (
                <tr key={c.id}>
                  <td>
                    <img src={c.product.image_url} style={{width: 100, height: 100}} className='rounded' alt="" />
                  </td>
                  <td>{c.product.name}</td>
                  
                  <td>
                  <div className='mt-4'>
                  <button className='btn btn-sm btn-secondary py-2 px-3' onClick={()=>subQty(c.id)}>-</button>
                  <button className='btn btn-sm btn-dark py-2 px-3'>{c.total_quantity}</button>
                  <button className='btn btn-sm btn-secondary py-2 px-3' onClick={()=>addQty(c.id)}>+</button>

                </div>
                  </td>
                </tr>
              ))
            }
        </tbody>
      </table>


      <div className="card card-body mt-3">
            <div className="form-group">
            <label htmlFor="">Name</label>
        <input type="text" className='form-control' value={name} onChange={(e)=>setName(e.target.value)} />
            </div>

            <div className="form-group">
            <label htmlFor="">Email</label>
        <input type="email" className='form-control' value={email} onChange={(e)=>setEmail(e.target.value)} />
            </div>

            <button className='btn btn-dark' onClick={checkOut}>Check Out</button>
      </div>
        </>

      )
    }

    </>
  )
}

export default Cart