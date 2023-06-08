import React from "react";
import { createRoot } from 'react-dom/client'
import { HashRouter, Routes, Route } from "react-router-dom";

import Detail from "./ProductDetail/Detail";

const MainRouter = () => {
    return (
        <HashRouter>
            <Routes>
                <Route path="/" element={<Detail />} />
            </Routes>
        </HashRouter>
    )
}
createRoot(document.querySelector('#root')).render(<MainRouter />);