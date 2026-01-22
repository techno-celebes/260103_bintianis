import Swal from "sweetalert2";

export function showAlert(data) {
    let iconType = "info"; 
    let timer = 7000; 

    let status = data.status;
    let message = data.message
    let title = data.title

    switch (status) {
        case 1:
            title = title || "Success";
            iconType = "success";
            timer = 2000;
            break;
        case 0:
            title = title || "Caution";
            iconType = "error";
            break;
        case 2:
            title = title || "Warning";
            iconType = "warning";
            break;
    }

    Swal.fire({
        title: title,
        html: message,
        icon: iconType,
        timer: timer,
        showConfirmButton: false,
    });
}

export function showAlertTypeTwo(status,message,title) {
    let iconType = "info"; 
    let timer = 7000; 

    switch (status) {
        case 1:
            title = title || "Success";
            iconType = "success";
            timer = 2000;
            break;
        case 0:
            title = title || "Error";
            iconType = "error";
            break;
        case 2:
            title = title || "Warning";
            iconType = "warning";
            break;
    }

    Swal.fire({
        title: title,
        html: message,
        icon: iconType,
        timer: timer,
        showConfirmButton: false,
    });
}