class Notification {
    success() {
        Toast.fire({
            icon: "success",
            title: "Successfully Done!",
        });
    }

    alert() {
        Toast.fire({
            icon: "alert",
            title: "Are you sure?",
        });
    }

    warning() {
        Toast.fire({
            icon: "warning",
            title: "Opps wrong",
        });
    }

    error() {
        Toast.fire({
            icon: "alert",
            title: "Something went wrong!",
        });
    }

    image_validation() {
        Toast.fire({
            icon: "error",
            title: "Upload image less then 1MB",
        });
    }
}

export default Notification = new Notification();
