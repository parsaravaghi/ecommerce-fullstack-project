import { BrowserRouter, Route, Routes } from "react-router-dom"
import Home from "../pages/Home"
import Header from "../components/header"

// set elements responsive by client's route
function Element()
{
    return(
        <BrowserRouter>
            <Header />
            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="*" element={<><p>404</p></>} />
            </Routes>
        </BrowserRouter>
    )
}

// Export
export default Element