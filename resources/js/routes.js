let login = require("./components/auth/login.vue").default;
let logout = require("./components/auth/logout.vue").default;
let register = require("./components/auth/register.vue").default;
let home = require("./components/home.vue").default;

// Customer Component
let storeCustomer = require("./components/customer/create.vue").default;
let customer = require("./components/customer/index.vue").default;
let editCustomer = require("./components/customer/edit.vue").default;

// Category Component
let storeCategory = require("./components/category/create.vue").default;
let category = require("./components/category/index.vue").default;
let editCategory = require("./components/category/edit.vue").default;

// Blog Category Component
let storeBlogCategory =
    require("./components/blog_category/create.vue").default;
let blogCategory = require("./components/blog_category/index.vue").default;
let editBlogCategory = require("./components/blog_category/edit.vue").default;

// Blog Component
let storeBlog = require("./components/blog/create.vue").default;
let blog = require("./components/blog/index.vue").default;
let editBlog = require("./components/blog/edit.vue").default;

// Brand Component
let storeBrand = require("./components/brand/create.vue").default;
let brand = require("./components/brand/index.vue").default;
let editBrand = require("./components/brand/edit.vue").default;

// Color Component
let storeColor = require("./components/color/create.vue").default;
let color = require("./components/color/index.vue").default;
let editColor = require("./components/color/edit.vue").default;

// Attribute Component
let storeAttribute = require("./components/attribute/create.vue").default;
let attribute = require("./components/attribute/index.vue").default;
let editAttribute = require("./components/attribute/edit.vue").default;

// Sub Category Component
let storeSubCategory = require("./components/sub_category/create.vue").default;
let subCategory = require("./components/sub_category/index.vue").default;
let subCategories =
    require("./components/sub_category/sub_category.vue").default;
let editSubCategory = require("./components/sub_category/edit.vue").default;

// Attribute Value Component
let storeAttributeValue =
    require("./components/attribute_value/create.vue").default;
let attributeValue = require("./components/attribute_value/index.vue").default;
let editAttributeValue =
    require("./components/attribute_value/edit.vue").default;

// Baby Component
let storeBaby = require("./components/baby/create.vue").default;
let baby = require("./components/baby/index.vue").default;
let editBaby = require("./components/baby/edit.vue").default;

// Employee Component
let storeEmployee = require("./components/employee/create.vue").default;
let employee = require("./components/employee/index.vue").default;
let editEmployee = require("./components/employee/edit.vue").default;

// Salary Component
let salary = require("./components/salary/all_employee.vue").default;
let paySalary = require("./components/salary/create.vue").default;
let allSalary = require("./components/salary/index.vue").default;
let viewSalary = require("./components/salary/view.vue").default;
let editSalary = require("./components/salary/edit.vue").default;

// Product Component
let storeProduct = require("./components/product/create.vue").default;
let product = require("./components/product/index.vue").default;
let editProduct = require("./components/product/edit.vue").default;

// Stock Component
let stock = require("./components/product/stock.vue").default;
let editStock = require("./components/product/edit-stock.vue").default;

// Order Component
let order = require("./components/order/order.vue").default;
let refund = require("./components/order/refund_order.vue").default;
let viewOrder = require("./components/order/view_order.vue").default;

// Supplier Component
let storeSupplier = require("./components/supplier/create.vue").default;
let supplier = require("./components/supplier/index.vue").default;
let editSupplier = require("./components/supplier/edit.vue").default;

export const routes = [
    { path: "/", component: login, name: "/" },
    { path: "/logout", component: logout, name: "/logout" },
    { path: "/register", component: register, name: "register" },
    { path: "/home", component: home, name: "home" },

    // Customer Routes
    {
        path: "/store-customer",
        component: storeCustomer,
        name: "store-customer",
    },
    { path: "/customer", component: customer, name: "customer" },
    {
        path: "/edit-customer/:id",
        component: editCustomer,
        name: "edit-customer",
    },
    // Category Routes
    {
        path: "/store-category",
        component: storeCategory,
        name: "store-category",
    },
    { path: "/category", component: category, name: "category" },
    {
        path: "/edit-category/:id",
        component: editCategory,
        name: "edit-category",
    },
    // Blog Routes
    {
        path: "/store-blog",
        component: storeBlog,
        name: "store-blog",
    },
    { path: "/blog", component: blog, name: "blog" },
    {
        path: "/edit-blog/:id",
        component: editBlog,
        name: "edit-blog",
    },
    // Blog Category Routes
    {
        path: "/store-blog-category",
        component: storeBlogCategory,
        name: "store-blog-category",
    },
    { path: "/blog-category", component: blogCategory, name: "blog-category" },
    {
        path: "/edit-blog-category/:id",
        component: editBlogCategory,
        name: "edit-blog-category",
    },
    // Sub Category Routes
    {
        path: "/store-sub-category/:id",
        component: storeSubCategory,
        name: "store-sub-category",
    },
    { path: "/sub-category/:id", component: subCategory, name: "sub-category" },
    { path: "/sub-category", component: subCategories, name: "sub-categories" },
    {
        path: "/edit-sub-category/:id",
        component: editSubCategory,
        name: "edit-sub-category",
    },
    // Attribute Value Routes
    {
        path: "/store-attribute-value/:id",
        component: storeAttributeValue,
        name: "store-attribute-value",
    },
    {
        path: "/attribute-value/:id",
        component: attributeValue,
        name: "attribute-value",
    },
    {
        path: "/edit-attribute-value/:id",
        component: editAttributeValue,
        name: "edit-attribute-value",
    },
    // Brand Routes
    {
        path: "/store-brand",
        component: storeBrand,
        name: "store-brand",
    },
    { path: "/brand", component: brand, name: "brand" },
    {
        path: "/edit-brand/:id",
        component: editBrand,
        name: "edit-brand",
    },
    // Color Routes
    {
        path: "/store-color",
        component: storeColor,
        name: "store-color",
    },
    { path: "/color", component: color, name: "color" },
    {
        path: "/edit-color/:id",
        component: editColor,
        name: "edit-color",
    },
    // Baby Routes
    {
        path: "/store-baby/:id",
        component: storeBaby,
        name: "store-baby",
    },
    { path: "/baby/:id", component: baby, name: "baby" },
    {
        path: "/edit-baby/:id",
        component: editBaby,
        name: "edit-baby",
    },

    // Employee Routes
    {
        path: "/store-employee",
        component: storeEmployee,
        name: "store-employee",
    },
    { path: "/employee", component: employee, name: "employee" },
    {
        path: "/edit-employee/:id",
        component: editEmployee,
        name: "edit-employee",
    },

    // Salary Routes
    { path: "/given-salary", component: salary, name: "given-salary" },
    { path: "/pay-salary/:id", component: paySalary, name: "pay-salary" },

    { path: "/salary", component: allSalary, name: "salary" },
    { path: "/view-salary/:id", component: viewSalary, name: "view-salary" },
    { path: "/edit-salary/:id", component: editSalary, name: "edit-salary" },

    // Product Routes
    { path: "/store-product", component: storeProduct, name: "store-product" },
    { path: "/product", component: product, name: "product" },
    { path: "/edit-product/:id", component: editProduct, name: "edit-product" },

    // Stock Routes
    { path: "/stock", component: stock, name: "stock" },
    { path: "/edit-stock/:id", component: editStock, name: "edit-stock" },

    // Order Routes
    { path: "/order", component: order, name: "order" },
    { path: "/refund", component: refund, name: "refund" },
    { path: "/view-order/:id", component: viewOrder, name: "view-order" },

    // Supplier Routes
    {
        path: "/store-supplier",
        component: storeSupplier,
        name: "store-supplier",
    },
    { path: "/supplier", component: supplier, name: "supplier" },
    {
        path: "/edit-supplier/:id",
        component: editSupplier,
        name: "edit-supplier",
    },
    // Attribute Routes
    {
        path: "/store-attribute",
        component: storeAttribute,
        name: "store-attribute",
    },
    { path: "/attribute", component: attribute, name: "attribute" },
    {
        path: "/edit-attribute/:id",
        component: editAttribute,
        name: "edit-attribute",
    },
];
