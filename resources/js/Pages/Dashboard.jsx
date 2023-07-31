import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import {useEffect, useState} from "react";
import {Card} from "flowbite-react";

export default function Dashboard({ auth }) {
    const [metric, setMetric] = useState([]);

    useEffect(() => {
        fetch('/api/metric')
        .then(response => response.json())
        .then(data => setMetric(data));
    },[]);

    console.log(metric)

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap gap-8">
                        {
                            metric.productStock  && ( <Card
                                imgAlt="Meaningful alt text for an image that is not purely decorative"
                                imgSrc={metric.productStock.image_url}
                                className={"w-3/12"}
                            >
                                <h5 className="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <p>
                                        Product with the largest stock:  {metric.productStock.name}
                                    </p>
                                </h5>
                                <p className="font-normal text-gray-700 dark:text-gray-400">
                                    Stock: {metric.productStock.stock}
                                </p>
                            </Card>)
                        }
                        {
                            metric.productSold && ( <Card
                                imgAlt="Meaningful alt text for an image that is not purely decorative"
                                imgSrc={metric.productSold.image_url}
                                className={"w-3/12"}
                            >
                                <h5 className="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <p>
                                        Best selling product:  {metric.productSold.name}
                                    </p>
                                </h5>
                                <p className="font-normal text-gray-700 dark:text-gray-400">
                                    Sold: {metric.productSold.sold}
                                </p>
                            </Card>)
                        }
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
