import { Link } from '@inertiajs/react';
import React from 'react';
const ProductShow = ({ product }) => {
    return (
        <div className="container mx-auto py-8">
            <h1 className="text-3xl font-bold mb-8 text-center">{product.name}</h1>
            <div className="max-w-md mx-auto border rounded-lg p-8 shadow-lg">
                <img src={product.image} alt={product.name} className="w-41 h-41 object-cover mb-4 rounded-lg" />
                <p className="text-gray-700 text-lg mb-4">{product.description}</p>
                <p className="text-green-500 text-2xl font-bold mb-4">${product.price}</p>
                <a
                    href="/products"
                    className="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                >
                    Back to Products
                </a>
            </div>
        </div>
    );
};

export default ProductShow;
