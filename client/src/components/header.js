import React from 'react'
import { Link } from 'react-router-dom'

function Header()
{
    return (
        <>
            <div className="nav navbar-expand-md navbar-light ">
                <div className="navbar-brand">
                    <box-icon size="30px" color="red" name="store"></box-icon>
                </div>
                <div className="collapse navbar-collapse">
                    <div className="navbar-nav">
                        <Link className='nav-item nav-link active' to="/">Home</Link>
                        <Link className='nav-item nav-link' to="/about">About</Link>
                        <Link className='nav-item nav-link' to="/Contact">Contact</Link>
                    </div>
                </div>
            </div>
        </>
    )
}

export default Header