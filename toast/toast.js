function toast({
    title = '',
    message = '',
    type = 'info',
    duration = 3000
}) {
    const toast = document.createElement('div')

    const main = document.getElementById('toast_container')

    //auto-remove toast
    const removeTimeoutID = setTimeout(() => {
        main.removeChild(toast)
    }, duration + 1000)

    //manual remove toast 
    toast.onclick = function (e) {
        if (e.target.closest('.toast_close')) {
            main.removeChild(toast)
            clearTimeout(removeTimeoutID)
        }
    }

    if (main) {
        const icons = {
            success: 'fa-solid fa-circle-check',
            error: 'fa-solid fa-triangle-exclamation',
            info: 'fa-solid fa-circle-exclamation'
        }

        const icon = icons[type]
        const delay = (duration / 1000).toFixed(2)

        toast.classList.add('toast', `toast--${type}`)
        toast.style.animation = `slideInLeft ease 1s, fadeOut linear 1s ${delay}s forwards`
        toast.innerHTML = `
                <div class="toast_icon">
                    <i class="${icon}"></i>
                </div>
                <div class="toast_body">
                    <div class="toast_title">
                        ${title}
                    </div>
                    <div class="toast_msg"> 
                        ${message}
                    </div>
                </div>
                <div class="toast_close">
                    <i class="fa-solid fa-xmark"></i>
                </div>`
        main.appendChild(toast)
    }
}

function showSuccess() {
    toast({
        title: 'Success',
        message: 'Initialization process completed',
        type: 'success',
        duration: 1000
    }
    )
}

function showSuccessLogin() {
    toast({
        title: 'Login Successfully',
        message: 'Welcome back',
        type: 'success',
        duration: 3000
    }
    )
}

function showSuccess(data) {
    toast({
        title: 'Success',
        message: data,
        type: 'success',
        duration: 2000
    }
    )
}

function showSuccessSignUp() {
    toast({
        title: 'Success!',
        message: 'Successfuly created new account',
        type: 'success',
        duration: 3000
    }
    )
}

function showError(data) {
    toast({
        title: 'Error!',
        message: data,
        type: 'error',
        duration: 3000
    }
    )
}

function showInfo(data) {
    toast({
        title: 'Info',
        message: data,
        type: 'info',
        duration: 8000
    }
    )
}