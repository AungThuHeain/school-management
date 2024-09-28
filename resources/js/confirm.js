export default function confirm() {

        return {
            confirmOpen:false,
            deleteModalOpen: false,
            deleteUrl: '',
            openDeleteModal(url) {
                this.deleteUrl = url;
                this.deleteModalOpen = true;
            },
            closeDeleteModal() {
                this.deleteModalOpen = false;
                this.deleteUrl = '';
            },
            destroy() {
                axios
                .post(this.deleteUrl, {_method: 'DELETE'})
                .then((response) => {
                    location.reload();
                })
                .catch((error) => {
                    if (error.response.status == 500) {
                        alert('Server Error');
                    }
                });
            },
        }
  }
