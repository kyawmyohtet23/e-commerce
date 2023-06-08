import React, {useState, useEffect} from 'react'
import Loader from '../Component/Loader'
import axios from 'axios';

const lang = localization;

const HomePage = () => {


  const [category, setCategory] = useState([]);
  const [productByCategory, setProductByCategory] = useState([]);
  const [featuredProduct, setFeaturedProduct] = useState([]);
  const [allProduct, setAllProduct] = useState([]);
  const [trendProduct, setTrendProduct] = useState([]);

  const [loader, setLoader] = useState(true);

  const fetchProduct = () => {
    axios.get('/api/home').then((res) => {
      // console.log(res.data);
      const {category, featuredProduct, productByCategory, allProduct, trendProduct} = res.data.data;
      setTrendProduct(trendProduct);
      setCategory(category);
      setFeaturedProduct(featuredProduct);
      setProductByCategory(productByCategory);  
      setAllProduct(allProduct);
      setLoader(false);
    });
  }
  useEffect(() => {
    fetchProduct();
  },[]);

  return (
    <>
    {
      loader ? <Loader /> : (
        <>
           <div className="container mt-4">
    <div className="d-flex justify-content-between">
      <div>
        <h3 className="ms-2">Categories</h3>
      </div>
      <div className="mt-2  d-flex menus">
        <div className="mx-3">
          <a href="" className="text-dark">
            Home
          </a>
        </div>
        <div className="mx-3">
          <a href="" className="text-dark">
            Product
          </a>
        </div>
        <div className="mx-3">
          <a href="" className="text-dark">
            Category
          </a>
        </div>
        <div className="mx-3">
          <a href="" className="text-dark">
            About
          </a>
        </div>
      </div>
    </div>

    <div className="mt-5 d-flex justify-content-around">
      
        {
          category.map(c => (
            <a href={`/category/${c.slug}`}>
            <div className="" key={c.slug}>
            <img 
              src={c.image_url}
              className="cat-img shadow rounded-circle"
              alt=""
              style={{ width: 150, height: 150 }}
            />

          </div>
          <h5 className="text-center mt-3">
            
              {/* <b>{c.name}</b> */}
              <b>
                {
                  localization == 'en' ? c.name : c.mm_name
                }
              </b>
              

            </h5>
            </a>
          ))
        }
    </div>

  </div>

  <div className="container mt-5">
    <h3>New Products</h3>
    <div className="row mt-4 ">
        {
          allProduct.map(p => (
            <div className="col-12 col-sm-6 col-md-3 col-lg-3" key={p.slug}>
          <a href={`/product-detail/${p.slug}`}>
          <div >
            <div className="card border-0">
              <img
                src={p.image_url}
                style={{ width: 150, height: 150 }}
                alt=""
                className='d-block mx-auto'
              />
              <div className="card-body text-center">
                <h6 className="">{p.name}</h6>
                <span className='text-dark'>{p.sale_price}ks</span>
              </div>
            </div>
          </div>
            </a>
            </div>
          ))
        }
    </div>



    <h3 className='mt-4'>Trending Now</h3>
    <div className="row mt-4 ">
        {
          trendProduct.map(p => (
            <div className="col-12 col-sm-6 col-md-3 col-lg-3" key={p.slug}>
          <a href={`/product-detail/${p.slug}`}>
          <div >
            <div className="card border-0">
              <img
                src={p.image_url}
                style={{ width: 150, height: 150 }}
                alt=""
                className='d-block mx-auto'
              />
              <div className="card-body text-center">
                <h6 className="">{p.name}</h6>
                <span className='text-dark'>{p.sale_price}ks</span>
              </div>
            </div>
          </div>
            </a>
            </div>
          ))
        }
    </div>
  </div>
        </>
      )
    }


</>

  )
}

export default HomePage