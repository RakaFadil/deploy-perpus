<template>

<div class="px-6 py-5">
    <p class="text-4xl text-center font-bold text-balance text-white font-poppins">Welcome,Admin!</p>
    <p class="text-xl text-center font-bold text-balance text-error font-poppins">Create and manage for app organization</p>
    <div class="divider"></div>
    <div class="grid md:grid-cols-4 lg:grid-cols-3 my-2 gap-3">
        <div class="card bg-primary-content text-neutral-content w-96">
            <div class="card-body items-center text-center">
                <h2 class="card-title text-3xl font-poppins">Books</h2>
                <i class="pi pi-book my-6" style="font-size: 4rem"></i>
                <div class="card-actions justify-end">
                <RouterLink to="/booksAdmin" class="btn btn-primary text-xl font-bold font-poppins">Edit</RouterLink>
                </div>
            </div>
        </div>
        <div class="card bg-primary-content text-neutral-content w-96">
            <div class="card-body items-center text-center">
                <h2 class="card-title text-3xl font-poppins">Categories</h2>
                <i class="pi pi-list my-6" style="font-size: 4rem"></i>
                <div class="card-actions justify-end">
                    <RouterLink to="/categoriesAdmin" class="btn btn-primary text-xl font-bold font-poppins">Edit</RouterLink>
                </div>
            </div>
        </div>
        <div class="card bg-primary-content text-neutral-content w-96">
            <div class="card-body items-center text-center">
                <h2 class="card-title text-3xl font-poppins">Borrow/return data</h2>
                <i class="pi pi-folder my-6" style="font-size: 4rem"></i>
                <div class="card-actions justify-end">
                    <RouterLink to="/borrows" class="btn btn-primary text-xl font-bold font-poppins">Edit</RouterLink>
                </div>
            </div>
        </div>
        <div class="card bg-primary-content text-neutral-content w-96">
            <div class="card-body items-center text-center">
                <h2 class="card-title text-3xl font-poppins">Roles</h2>
                <i class="pi pi-users my-6" style="font-size: 4rem"></i>
                <div class="card-actions justify-end">
                    <RouterLink to="/rolesAdmin" class="btn btn-primary text-xl font-bold font-poppins">Edit</RouterLink>
                </div>
            </div>
        </div>
    </div>
    
</div>
    
</template>