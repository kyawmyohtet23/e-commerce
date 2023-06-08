import axios from 'axios'
import React, { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom'
import Loader from '../Component/Loader'

const ProductDetail = () => {
  const [product, setProduct] = useState({});
  const [brand, setBrand] = useState({});
  const [category, setCategory] = useState({});
  const [color, setColor] = useState([]);

  const [loader, setLoader] = useState(true);

  const [cartCount, setCartCount] = useState(1);

  const [cartLoader, setCartLoader] = useState(false);



  const product_slug = window.product_slug;

  useEffect(() => {
    axios.get('/api/product-detail/' + product_slug).then(({data}) => {
      // console.log(data.data.color);
      setProduct(data.data);
      setBrand(data.data.brand);
      setColor(data.data.color);
      setCategory(data.data.category);
      setLoader(false);

      // console.log(product);
    });



  },[]);

  // functions
  var qty = product.total_quantity;

  const reduce = () => {
    // console.log(product.total_quantity);
    if(cartCount > 1){
    setCartCount(prevState => prevState - 1);
    }
  }

  const add = () => {
    if(cartCount < qty){
      setCartCount(prevState => prevState + 1);
    }
  }

    // add to cart
    const addToCart = () => {
      setCartLoader(true);
    const user_id = window.auth.id;
    // const qty = cartCount;
    // console.log(qty);
    // console.log(user_id);
      axios.post('/api/add-to-cart/' + product_slug, {user_id}).then(d => {
        const {data} = d;
        if(data.false) {
      setCartLoader(false);

          // showToast('Product Not Found');

        } else {


          window.updateCart(data.data);
          // showToast('Product added to cart');
          setCartLoader(false);

        }
      });
    }

  return (
    <>
      {
        loader ? <Loader /> : (
          <div className="container" style={{ marginTop: 100 }}>
          <div className="card shadow-sm p-4">
            <div className="row">
              <div className="col-6">
                <img
                  src={product.image_url}
                  className="d-block mx-auto"
                  alt=""
                  style={{ width: 300, height: 300 }}
                />
              </div>
              <div className="col-6">
                <h5>
                  {product.name}
                </h5>
                <div className="d-flex mt-3">
                  <div>
                    <h6 className="text-muted">Brand:</h6>
                    <small className="border border-dark p-1 rounded text-dark" >{brand.name}</small>
                  </div>
                  <div className="mx-5">
                    <h6 className="text-muted">Category:</h6>
                    <small className="border border-dark p-1 rounded text-dark">{category.name}</small>
                  </div>
                </div>
                <div className="d-flex mt-4">
                  <div>
                    <h6 className="text-muted">Price:</h6>
                    <span className="text-dark">
                      <b>{product.sale_price}ks</b>
                    </span>
                  </div>
                  <div className="ms-5">
                    <h6 className="text-muted">Stock Quantity:</h6>
                    <button className="btn btn-sm btn-dark d-block mx-auto py-0 px-1">{product.total_quantity}</button>
                  </div>
                </div>

                
                <div className=" color mt-3">
                  <h6 className="text-muted">Color:</h6>
                  {
                    color.map(c => (
                  <small className="border border-dark p-1 rounded text-dark me-2" key={c.slug}>{c.name}</small>
        
                    ))
                  }
                </div>

                <div className='mt-4'>
                  <button className='btn btn-sm btn-secondary py-2 px-3' onClick={reduce}>-</button>
                  <button className='btn btn-sm btn-dark py-2 px-3'>{cartCount}</button>
                  <button className='btn btn-sm btn-secondary py-2 px-3' onClick={add}>+</button>
                  <button className='btn btn-sm btn-danger py-2'
                  onClick={()=>addToCart()}
                  disabled={cartLoader}
                  >
                  {
                    cartLoader && (
                      <>
                        <div className="spinner-border spinner-border-sm me-2" role="status">
                    <span className="visually-hidden">Loading...</span>
                  </div>
                      </>
                    )
                  }

                    Add To Cart</button>
                </div>
              </div>
            </div>
          </div>

          
        </div>
        )
      }

    </>
  )
}

export default ProductDetail