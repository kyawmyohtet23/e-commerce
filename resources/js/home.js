import React from "react";
import { createRoot } from 'react-dom/client'
import { HashRouter, Routes, Route } from "react-router-dom";
import HomePage from "./Home/HomePage";


const MainRouter = () => {
    return (
        <HashRouter>
            <Routes>
                <Route path="/" element={<HomePage />} />
            </Routes>
        </HashRouter>
    )
}
createRoot(document.querySelector('#root')).render(<MainRouter />);