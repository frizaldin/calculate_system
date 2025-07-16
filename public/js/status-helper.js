/**
 * Status Helper untuk JavaScript
 * Helper functions untuk menangani status kategori di frontend
 */

class StatusHelper {
    /**
     * Konversi status boolean ke teks
     * @param {boolean|null} status 
     * @returns {string}
     */
    static getStatusText(status) {
        if (status === null || status === undefined) {
            return 'Tidak Diketahui';
        }
        return status ? 'Aktif' : 'Nonaktif';
    }

    /**
     * Konversi status boolean ke badge HTML
     * @param {boolean|null} status 
     * @returns {string}
     */
    static getStatusBadge(status) {
        if (status === null || status === undefined) {
            return '<span class="badge bg-secondary">Tidak Diketahui</span>';
        }
        
        const text = this.getStatusText(status);
        const className = status ? 'bg-success' : 'bg-danger';
        
        return `<span class="badge ${className}">${text}</span>`;
    }

    /**
     * Konversi status boolean ke icon
     * @param {boolean|null} status 
     * @returns {string}
     */
    static getStatusIcon(status) {
        if (status === null || status === undefined) {
            return '<i class="fa-solid fa-question-circle text-secondary"></i>';
        }
        
        return status 
            ? '<i class="fa-solid fa-check-circle text-success"></i>' 
            : '<i class="fa-solid fa-times-circle text-danger"></i>';
    }

    /**
     * Konversi teks status ke boolean
     * @param {string} statusText 
     * @returns {boolean|null}
     */
    static getStatusFromText(statusText) {
        if (!statusText) return null;
        
        const text = statusText.toLowerCase().trim();
        
        const activeValues = ['aktif', 'active', '1', 'true', 'yes'];
        const inactiveValues = ['nonaktif', 'inactive', '0', 'false', 'no'];
        
        if (activeValues.includes(text)) {
            return true;
        }
        
        if (inactiveValues.includes(text)) {
            return false;
        }
        
        return null;
    }

    /**
     * Dapatkan opsi status untuk dropdown
     * @returns {Object}
     */
    static getStatusOptions() {
        return {
            '': 'Semua Status',
            '1': 'Aktif',
            '0': 'Nonaktif'
        };
    }

    /**
     * Dapatkan opsi status untuk radio button
     * @returns {Object}
     */
    static getStatusRadioOptions() {
        return {
            '1': 'Aktif',
            '0': 'Nonaktif'
        };
    }

    /**
     * Cek apakah status aktif
     * @param {boolean|null} status 
     * @returns {boolean}
     */
    static isActive(status) {
        return status === true;
    }

    /**
     * Cek apakah status nonaktif
     * @param {boolean|null} status 
     * @returns {boolean}
     */
    static isInactive(status) {
        return status === false;
    }

    /**
     * Toggle status
     * @param {boolean|null} status 
     * @returns {boolean}
     */
    static toggleStatus(status) {
        return !status;
    }

    /**
     * Konversi form data status ke boolean
     * @param {string|boolean} status 
     * @returns {boolean}
     */
    static convertFormStatus(status) {
        if (typeof status === 'boolean') {
            return status;
        }
        
        if (typeof status === 'string') {
            return status === 'on' || status === '1' || status === 'true';
        }
        
        return false;
    }

    /**
     * Render status dropdown
     * @param {string} name - Nama field
     * @param {string} selectedValue - Nilai yang dipilih
     * @param {string} className - CSS class
     * @returns {string}
     */
    static renderStatusDropdown(name = 'status', selectedValue = '', className = 'form-control') {
        const options = this.getStatusOptions();
        let html = `<select name="${name}" class="${className}">`;
        
        Object.entries(options).forEach(([value, label]) => {
            const selected = value === selectedValue ? 'selected' : '';
            html += `<option value="${value}" ${selected}>${label}</option>`;
        });
        
        html += '</select>';
        return html;
    }

    /**
     * Render status radio buttons
     * @param {string} name - Nama field
     * @param {string} selectedValue - Nilai yang dipilih
     * @param {string} className - CSS class
     * @returns {string}
     */
    static renderStatusRadio(name = 'status', selectedValue = '1', className = 'form-check-input') {
        const options = this.getStatusRadioOptions();
        let html = '';
        
        Object.entries(options).forEach(([value, label]) => {
            const checked = value === selectedValue ? 'checked' : '';
            const id = `status${label}`;
            html += `
                <div class="form-check form-check-inline">
                    <input class="${className}" type="radio" name="${name}" 
                           id="${id}" value="${value}" ${checked}>
                    <label class="form-check-label" for="${id}">${label}</label>
                </div>
            `;
        });
        
        return html;
    }
}

// Global helper functions (mirror dari PHP helper)
window.statusText = (status) => StatusHelper.getStatusText(status);
window.statusBadge = (status) => StatusHelper.getStatusBadge(status);
window.statusIcon = (status) => StatusHelper.getStatusIcon(status);
window.statusFromText = (statusText) => StatusHelper.getStatusFromText(statusText);
window.statusOptions = () => StatusHelper.getStatusOptions();
window.statusRadioOptions = () => StatusHelper.getStatusRadioOptions();
window.isStatusActive = (status) => StatusHelper.isActive(status);
window.isStatusInactive = (status) => StatusHelper.isInactive(status);
window.toggleStatus = (status) => StatusHelper.toggleStatus(status);
window.convertFormStatus = (status) => StatusHelper.convertFormStatus(status);

// Export untuk module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = StatusHelper;
} 