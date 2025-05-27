import React from 'react'
import {Container, Nav, Navbar, Offcanvas}  from 'react-bootstrap'
import { Link } from 'react-router-dom'

function Header()
{
    return (
        <>
            {/* header component */}
            <Navbar bg='light' expand='md' >
                <Container fluid={true}>
                    <Navbar.Brand>
                        <Link to='/'>
                            <box-icon name='store' size='40px' color='red' />
                        </Link>
                    </Navbar.Brand>
                    <Navbar.Toggle  style={{outline:"none", boxShadow:"none" , border:"none"}} >
                        <box-icon name='menu' size='30px' />
                    </Navbar.Toggle>
                    <Navbar.Offcanvas placement='end' >
                        <Offcanvas.Header className='flex-row-reverse justify-content-between m-0' closeButton >
                            <Offcanvas.Title>
                                <Nav className='flex-row align-items-center flex-row-reverse justify-content-center'>
                                    <Nav.Item>
                                        <Link to='/account'><box-icon type='solid' name='user-circle' size='30px' /></Link>
                                    </Nav.Item>
                                </Nav>
                            </Offcanvas.Title>
                        </Offcanvas.Header>
                        <Offcanvas.Body dir='rtl' className='justify-content-center m-1 p-2'>
                            <Nav>
                                <Nav.Item className='d-flex gap-1 justify-content-start  align-items-center'>
                                    <box-icon name='home' type='solid' size='20px' />
                                    <Link className='nav-link active' role='button' to="/">خانه</Link>
                                </Nav.Item>
                                <Nav.Item className='d-flex gap-1 justify-content-start align-items-center'>
                                    <box-icon name='cart' type='solid' size='20px' />
                                    <Link className='nav-link' role='button' to="/">محصولات</Link>
                                </Nav.Item>
                                <Nav.Item className='d-flex gap-1 justify-content-start align-items-center'>
                                    <box-icon name='info-circle' type='solid' size='20px' />
                                    <Link className='nav-link ' role='button' to="/about">درباره ما</Link>
                                </Nav.Item>
                                <Nav.Item className='d-flex gap-1 justify-content-start align-items-center'>
                                    <box-icon name='phone' type='solid' size='20px' />
                                    <Link className='nav-link' role='button' to="/contact">ارتباط با ما</Link>
                                </Nav.Item>
                            </Nav>
                        </Offcanvas.Body>
                    </Navbar.Offcanvas>
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