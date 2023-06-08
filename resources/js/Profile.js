import React from "react";
import { createRoot } from 'react-dom/client'
import { HashRouter, Routes, Route, Link } from "react-router-dom";
import Order from "./Profile/Order";
import Cart from "./Profile/Cart";
import EditAccount from "./Profile/EditAccount";


const Setting = () => {
    return (
        <HashRouter>
            <Link to={"/"} className="btn btn-dark btn-sm">Cart</Link>
            <Link to={"/order"} className="btn btn-dark btn-sm">Order</Link>
            <Link to={"/edit"} className="btn btn-dark btn-sm">Edit Account</Link>

            <Routes>
                <Route path="/order" element={<Order />} />
                <Route path="/" element={<Cart />} />
                <Route path="/edit" element={<EditAccount />} />
            </Routes>
        </HashRouter>
    )
}
createRoot(document.querySelector('#root')).render(<Setting />);