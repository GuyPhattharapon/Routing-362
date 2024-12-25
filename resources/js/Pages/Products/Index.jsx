import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
const ProductIndex = ({ products }) => {
    return (

        <AuthenticatedLayout>
        <div className="container mx-auto py-8">
            <h1 className="text-4xl font-bold mb-8 text-center text-orange-500">Product List</h1>
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {products.map((product) => (
                    <div key={product.id} className="border rounded-lg p-4 shadow-lg">
                        <img src={product.image} alt={product.name} className="w-41 h-41 object-cover mb-4 rounded-lg" />
                        <h2 className="text-xl font-semibold">{product.name}</h2>
                        <p className="text-gray-700">{product.description}</p>
                        <p className="text-green-500 font-bold">${product.price}</p>
                        <a
                            href={`/products/${product.id}`}
                            className="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                        >
                            View Details
                        </a>
                    </div>
                ))}
            </div>
        </div>
        </AuthenticatedLayout>
    );
};

export default ProductIndex;
