import React from 'react'
import {Container, Nav, Navbar, Row}  from 'react-bootstrap'
import { Link } from 'react-router-dom'

function Header()
{
    return (
        <>
            {/* header component */}
            <Navbar bg='light' expand='md' dir='rtl'>
                <Container fluid={true}>
                    <Navbar.Brand>
                        <Link to='/'>
                            <box-icon name='store' size='40px' color='red' />
                        </Link>
                    </Navbar.Brand>
                    <Navbar.Toggle  style={{outline:"none", boxShadow:"none" , border:"none"}} >
                        <box-icon name='menu' size='30px' />
                    </Navbar.Toggle>
                    
                    <Navbar.Collapse className='align-items-center justify-content-center'>
                        <Nav>
                            <Nav.Item>
                                <Link className='nav-link active' role='button' to="/">خانه</Link>
                            </Nav.Item>
                            <Nav.Item>
                                <Link className='nav-link' role='button' to="/">محصولات</Link>
                            </Nav.Item>
                            <Nav.Item>
                                <Link className='nav-link' role='button' to="/about">درباره ما</Link>
                            </Nav.Item>
                            <Nav.Item>
                                <Link className='nav-link' role='button' to="/contact">ارتباط با ما</Link>
                            </Nav.Item>
                        </Nav>
                    </Navbar.Collapse>
                    <div className='collapse navbar-collapse flex-grow-0'>
                        <Nav dir='ltr'>
                            <Nav.Item>
                                <Link to='/account'><box-icon type='solid' name='user-circle' size='30px' /></Link>
                            </Nav.Item>
                            <Nav.Item>
                                <Link to='/'><box-icon type='solid' name='bell' animation='tada' size='30px' /></Link>
                            </Nav.Item>
                        </Nav>
                    </div>
                </Container>
            </Navbar>
        </>
    )
}

export default Header