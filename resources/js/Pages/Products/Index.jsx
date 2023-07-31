import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head} from '@inertiajs/react';
import {useEffect, useState} from "react";
import {Button, Modal, Checkbox, Label, TextInput, Select} from 'flowbite-react';

export default function Dashboard({ auth }) {

    const [products, setProducts] = useState([]);
    const [category, setCategory] = useState([]);
    const [openModal, setOpenModal] = useState();
    const [inputs, setInputs] = useState([])
    const [edit, setEdit] = useState(0)
    const props = { openModal, setOpenModal };

    const getProduct = () => {
        fetch('/api/products')
            .then(response => response.json())
            .then(data => setProducts(data));
    }


    useEffect(() => {
        getProduct();
        fetch('/api/categories')
            .then(response => response.json())
            .then(data => setCategory(data));
    }, [])

    const handleEdit = (product) => {
        setInputs(product)
        setEdit(product.id)
        props.setOpenModal('default')
    }

    const handleCreate = () => {
      const request = edit === 0 ? fetch('/api/products', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify(inputs)
        }) : fetch('/api/products/'+edit, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify(inputs)
        })
        request.then(response => response.json())
            .then(data => {
                if (data.errors) {
                    alert("Error to created product")
                }else{
                    getProduct();
                }

            })
    }

    const handleChange = (e) => {
        setInputs(inputs => ({...inputs, [e.target.name]: e.target.value}))
    }

    const handleDelete = (product) => {
        fetch('/api/products/'+product.id, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            }
        }).then(response => response.json())
            .then(data => {
                if (data.errors) {
                    alert("Error to delete product")
                }else{
                    getProduct();
                }
            });
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Products</h2>}
        >
            <Head title="Dashboard" />
            <div className="max-w-8xl mx-auto p-6 lg:p-8">
                <div className='w-full flex justify-end py-4'>
                    <div className='w-48'>
                        <a href='#' className='block text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800' onClick={() => { setInputs([]); props.setOpenModal('default')}}>Create one</a></div>
                </div>
                 <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" className="px-6 py-3">Name</th>
                            <th scope="col" className="px-6 py-3">Reference</th>
                            <th scope="col" className="px-6 py-3">Price</th>
                            <th scope="col" className="px-6 py-3">Weight</th>
                            <th scope="col" className="px-6 py-3">Stock</th>
                            <th scope="col" className="px-6 py-3">image_url</th>
                            <th scope="col" className="px-6 py-3">Category</th>
                            <th scope="col" className="px-6 py-3">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        {products.map((product) => (
                            <tr className="bg-white border-b dark:bg-gray-900 dark:border-gray-700" key={product.id}>
                                <td scope="row" className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{product.name}</td>
                                <td className="px-6 py-4">{product.reference}</td>
                                <td className="px-6 py-4">{product.price}</td>
                                <td className="px-6 py-4">{product.weight}</td>
                                <td className="px-6 py-4">{product.stock}</td>
                                <td className="px-6 py-4">{product.image_url}</td>
                                <td className="px-6 py-4">{product.category.name}</td>
                                <td className="px-6 py-4 flex flex-row gap-4">
                                    <a href='#' className='font-medium text-blue-600 dark:text-blue-500 hover:underline' onClick={() => handleEdit(product)}>Edit</a>
                                    <a href='#' className='font-medium text-red-600 dark:text-red-500 hover:underline' onClick={() => handleDelete(product)}>Delete</a>
                                </td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                </div>
            </div>


            <Modal show={props.openModal === 'default'} onClose={() => props.setOpenModal(undefined)}>
                <Modal.Header>Create produc</Modal.Header>
                <Modal.Body>
                    <form className="flex max-w-md flex-col gap-4">
                        <div>
                            <div className="mb-2 block">
                                <Label
                                    htmlFor="name_product"
                                    value="Name"
                                />
                            </div>
                            <TextInput
                                id="name_product"
                                placeholder="Name product"
                                required
                                type="text"
                                name="name"
                                value={inputs.name}
                                onChange={handleChange}
                            />
                        </div>
                        <div>
                            <div className="mb-2 block">
                                <Label
                                    htmlFor="price"
                                    value="Price"
                                />
                            </div>
                            <TextInput
                                id="price"
                                required
                                type="number"
                                name="price"
                                value={inputs.price}
                                onChange={handleChange}
                            />
                        </div>
                        <div>
                            <div className="mb-2 block">
                                <Label
                                    htmlFor="weight"
                                    value="Weight"
                                />
                            </div>
                            <TextInput
                                id="weigth"
                                required
                                type="number"
                                name="weight"
                                value={inputs.weight}
                                onChange={handleChange}
                            />
                        </div>
                        <div>
                            <div className="mb-2 block">
                                <Label
                                    htmlFor="stock"
                                    value="Stock"
                                />
                            </div>
                            <TextInput
                                id="stock"
                                required
                                type="number"
                                name="stock"
                                value={inputs.stock}
                                onChange={handleChange}
                            />
                        </div>
                        <div>
                            <div className="mb-2 block">
                                <Label
                                    htmlFor="image_url"
                                    value="Imagen Url"
                                />
                            </div>
                            <TextInput
                                id="image_url"
                                required
                                type="text"
                                name="image_url"
                                value={inputs.image_url}
                                onChange={handleChange}
                            />
                        </div>
                        <div
                            className="max-w-md"
                            id="select"
                        >
                            <div className="mb-2 block">
                                <Label
                                    htmlFor="category"
                                    value="Select your category"
                                />
                            </div>
                            <Select
                                id="category"
                                required
                                name="category_id"
                                value={inputs.category_id}
                                onChange={handleChange}
                            >
                                { category && category.map((c)=>(
                                    <option key={c.id}>{c.name}</option>
                                ))}
                            </Select>
                        </div>
                    </form>
                </Modal.Body>
                <Modal.Footer>
                    <Button onClick={() => {
                        handleCreate();
                        props.setOpenModal(undefined)
                    }}>Send</Button>
                    <Button color="gray" onClick={() => props.setOpenModal(undefined)}>
                        Close
                    </Button>
                </Modal.Footer>
            </Modal>
        </AuthenticatedLayout>
    );
}
