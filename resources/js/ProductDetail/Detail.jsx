import axios from 'axios';
import React from 'react'
import { useState } from 'react';
import StarRatings from 'react-star-ratings';

const product = blade_product_data;

const Detail = () => {

  const [reviews, setReviews] = useState(product.review);
  const [review, setReview] = useState('');
  const [reviewCount, setReviewCount] = useState(0);

  const [cartCount, setCartCount] = useState(1);

  // console.log(reviews);

  const addToCart = () => {
    const product_slug = product.slug;
    const cartQty = cartCount;
    const product_id = product.id;

    const data = new FormData();
    data.append('cartQty', cartQty);
    data.append('slug', product_slug);
    data.append('id', product_id);

    axios.post('/api/add-to-cart', data).then((res) => {

      if (res.data == 'product_not_found') {
        errorToast('Product Not Found');
        return;
      }

      if (res.data == 'not_authorized') {
        errorToast('Please Login First!');
        return;
      }

      changeCartTotal(res.data.cartTotal);
    });
  }


  // make review
  const makeReview = () => {
    const product_slug = product.slug;
    const data = new FormData();
    data.append('rating', reviewCount);
    data.append('review', review);
    data.append('slug', product_slug);

    axios.post('/api/make-review', data).then((res) => {
      console.log(res.data);
      if (res.data == 'product_not_found') {
        errorToast('Product Not Found');
        return;
      }

      setReviews([
        ...reviews,
        res.data
      ])

      setReviewCount(0);
    })
  }


  const add = () => {
    if (cartCount < product.total_quantity) {
      setCartCount(cartCount + 1);
    }

  }

  const sub = () => {
    if (cartCount > 1) {
      setCartCount(cartCount - 1);
    }
  }

  return (
    <>

      <div className="container">
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
                <b>
                  {product.name}

                </b>
              </h5>
              <div className="d-flex mt-3">
                <div>
                  <h6 className="text-muted">Brand:</h6>
                  <small className="border border-dark p-1 rounded text-dark" >{product.brand.name}</small>
                </div>
                <div className="mx-5">
                  <h6 className="text-muted">Category:</h6>
                  <small className="border border-dark p-1 rounded text-dark">{product.category.name}</small>
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
                  product.color.map(c => (
                    <small className="border border-dark p-1 rounded text-dark me-2" key={c.slug}>{c.name}</small>

                  ))
                }

              </div>

              <div className='mt-4'>
                <button className='btn btn-sm btn-secondary py-2 px-3' onClick={sub}>-</button>
                <button className='btn btn-sm btn-dark py-2 px-3'>{cartCount}</button>
                <button className='btn btn-sm btn-secondary py-2 px-3' onClick={add}>+</button>
                <button className='btn btn-sm btn-danger py-2' onClick={addToCart}>Add To Cart</button>
              </div>
            </div>
          </div>


          <div className="w-100 mt-5">
            {/* loop review */}

            {
              reviews.map(d => (
                <div className="review" key={d.id}>
                  <div className="card p-3">
                    <div className="row">
                      <div className="col-md-2">
                        <div className="d-flex justify-content-between">
                          <img
                            className="w-100 rounded-circle"
                            src=""
                            alt=""
                          />
                        </div>
                      </div>
                      <div className="col-md-10">
                        <div className="rating">
                          <StarRatings
                            rating={d.rating}
                            starRatedColor="pink"
                            numberOfStars={5}
                            name='rating'
                            starDimension="20px"
                          />
                        </div>
                        <div className="name">
                          <b>{d.user.name}</b>
                        </div>
                        <div className="mt-3">
                          <small>
                            {d.review}
                          </small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              ))
            }
            <div className="add-review mt-3">
              <h4>Make Review</h4>
              <div className="">
                <StarRatings
                  rating={reviewCount}
                  starRatedColor="blue"
                  changeRating={(rate) => {
                    setReviewCount(rate);
                  }}
                  numberOfStars={5}
                  name='rating'
                  starDimension="30px"
                />
              </div>
              <div>
                <textarea
                  className="form-control"
                  rows={5}
                  placeholder="enter review"
                  onChange={(e) => setReview(e.target.value)}
                  value={review}
                />
                <button className="btn btn-dark float-right mt-3" onClick={makeReview}>Review</button>
              </div>
            </div>
          </div>
        </div>


      </div>
    </>
  )
}

export default Detail