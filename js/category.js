/**
 * Category Management JavaScript
 * Contoh penggunaan API Category dengan AJAX
 */

class CategoryManager {
    constructor() {
        this.baseUrl = '/categories';
        this.setupEventListeners();
    }

    setupEventListeners() {
        // Form submit untuk create
        const createForm = document.getElementById('category-create-form');
        if (createForm) {
            createForm.addEventListener('submit', (e) => this.handleCreate(e));
        }

        // Form submit untuk update
        const updateForm = document.getElementById('category-update-form');
        if (updateForm) {
            updateForm.addEventListener('submit', (e) => this.handleUpdate(e));
        }

        // Delete buttons
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('delete-category')) {
                e.preventDefault();
                const id = e.target.dataset.id;
                this.handleDelete(id);
            }
        });

        // Edit buttons
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('edit-category')) {
                e.preventDefault();
                const id = e.target.dataset.id;
                this.handleEdit(id);
            }
        });
    }

    // Get all categories
    async getAllCategories(params = {}) {
        try {
            const queryString = new URLSearchParams(params).toString();
            const response = await fetch(`${this.baseUrl}?${queryString}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();
            return result;
        } catch (error) {
            console.error('Error fetching categories:', error);
            return {
                success: false,
                message: 'Terjadi kesalahan saat mengambil data',
                data: null
            };
        }
    }

    // Create category
    async createCategory(formData) {
        try {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();
            return result;
        } catch (error) {
            console.error('Error creating category:', error);
            return {
                success: false,
                message: 'Terjadi kesalahan saat membuat kategori',
                data: null
            };
        }
    }

    // Update category
    async updateCategory(id, formData) {
        try {
            const response = await fetch(`${this.baseUrl}/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();
            return result;
        } catch (error) {
            console.error('Error updating category:', error);
            return {
                success: false,
                message: 'Terjadi kesalahan saat memperbarui kategori',
                data: null
            };
        }
    }

    // Delete category
    async deleteCategory(id) {
        try {
            const response = await fetch(`${this.baseUrl}/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                }
            });

            const result = await response.json();
            return result;
        } catch (error) {
            console.error('Error deleting category:', error);
            return {
                success: false,
                message: 'Terjadi kesalahan saat menghapus kategori',
                data: null
            };
        }
    }

    // Get category by ID
    async getCategoryById(id) {
        try {
            const response = await fetch(`${this.baseUrl}/${id}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();
            return result;
        } catch (error) {
            console.error('Error fetching category:', error);
            return {
                success: false,
                message: 'Terjadi kesalahan saat mengambil data kategori',
                data: null
            };
        }
    }

    // Handle create form submit
    async handleCreate(event) {
        event.preventDefault();
        
        const form = event.target;
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());
        
        // Convert status to boolean using helper
        data.status = window.convertFormStatus ? window.convertFormStatus(data.status) : (data.status === 'on' || data.status === '1' || data.status === true);
        
        const result = await this.createCategory(data);
        
        if (result.success) {
            this.showSuccess(result.message);
            form.reset();
            this.loadCategories(); // Reload table
        } else {
            this.showError(result.message);
            if (result.errors) {
                this.showValidationErrors(result.errors);
            }
        }
    }

    // Handle update form submit
    async handleUpdate(event) {
        event.preventDefault();
        
        const form = event.target;
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());
        const id = form.dataset.categoryId;
        
        // Convert status to boolean using helper
        data.status = window.convertFormStatus ? window.convertFormStatus(data.status) : (data.status === 'on' || data.status === '1' || data.status === true);
        
        const result = await this.updateCategory(id, data);
        
        if (result.success) {
            this.showSuccess(result.message);
            this.loadCategories(); // Reload table
        } else {
            this.showError(result.message);
            if (result.errors) {
                this.showValidationErrors(result.errors);
            }
        }
    }

    // Handle delete
    async handleDelete(id) {
        if (!confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
            return;
        }

        const result = await this.deleteCategory(id);
        
        if (result.success) {
            this.showSuccess(result.message);
            this.loadCategories(); // Reload table
        } else {
            this.showError(result.message);
        }
    }

    // Handle edit
    async handleEdit(id) {
        const result = await this.getCategoryById(id);
        
        if (result.success) {
            this.populateEditForm(result.data);
        } else {
            this.showError(result.message);
        }
    }

    // Load categories and display in table
    async loadCategories(params = {}) {
        const result = await this.getAllCategories(params);
        
        if (result.success) {
            this.displayCategories(result.data);
        } else {
            this.showError(result.message);
        }
    }

    // Display categories in table
    displayCategories(categories) {
        const tableBody = document.getElementById('categories-table-body');
        if (!tableBody) return;

        tableBody.innerHTML = '';

        categories.data.forEach(category => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${category.id}</td>
                <td>${category.name}</td>
                <td>${category.description || '-'}</td>
                <td>
                    ${window.statusBadge ? window.statusBadge(category.status) : `<span class="badge ${category.status ? 'bg-success' : 'bg-danger'}">${category.status ? 'Aktif' : 'Nonaktif'}</span>`}
                </td>
                <td>${category.created_at}</td>
                <td>
                    <button class="btn btn-sm btn-primary edit-category" data-id="${category.id}">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-danger delete-category" data-id="${category.id}">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Populate edit form
    populateEditForm(category) {
        const form = document.getElementById('category-update-form');
        if (!form) return;

        form.dataset.categoryId = category.id;
        form.querySelector('[name="name"]').value = category.name;
        form.querySelector('[name="description"]').value = category.description || '';
        form.querySelector('[name="status"]').checked = category.status;

        // Show modal or form
        const modal = document.getElementById('edit-category-modal');
        if (modal) {
            const bootstrapModal = new bootstrap.Modal(modal);
            bootstrapModal.show();
        }
    }

    // Show validation errors
    showValidationErrors(errors) {
        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        // Show new errors
        Object.keys(errors).forEach(field => {
            const input = document.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback error-message';
                errorDiv.textContent = errors[field][0];
                input.parentNode.appendChild(errorDiv);
            }
        });
    }

    // Show success message
    showSuccess(message) {
        // You can use any notification library like SweetAlert2, Toastr, etc.
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: message,
                timer: 3000
            });
        } else {
            alert(message);
        }
    }

    // Show error message
    showError(message) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: message
            });
        } else {
            alert('Error: ' + message);
        }
    }

    // Get CSRF token
    getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.categoryManager = new CategoryManager();
    
    // Load categories on page load
    if (document.getElementById('categories-table-body')) {
        window.categoryManager.loadCategories();
    }
}); 