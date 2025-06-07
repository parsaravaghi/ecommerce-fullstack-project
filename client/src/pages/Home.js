import React, { useEffect } from 'react'

import test1 from '../assets/imgs/test1.jpg'

import Aos from "aos"
import 'aos/dist/aos.css';

function Home()
{
    useEffect(()=>{
        Aos.init()
    },[])
    return(
        <>
            <div className="jumbotron">
                
            </div>
            
            <div className="products p-2">
                <div className="product-box">
                    <div className="products container container-fluid">
                        <div className="row g-3 ">
                            {[1,2,3,4,5,6,7 ,2,2,2,2,2,1].map(i=>(
                                <>
                                    <div data-aos="fade-up" className="product bg-light g-3 col-4 col-lg-2 col-md-4 col-sm-4 d-flex flex-column justify-content-center align-items-center col">
                                        <img className='img-fluid img-thumbnail' src={test1} alt="" />
                                        <div className="info p-3 d-flex flex-column align-items-center justify-content-center ">
                                            <p className='title'>نام محصول</p>
                                            <p>130000</p>
                                            <button><box-icon name='cart' /></button>
                                        </div>
                                    </div>
                                </>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

export default Home