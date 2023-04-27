function show(message) {
    
    let code = `
        <div class="notification">
            <p>${message}</p>
        </div>
    `;

    let notification = document.createElement('div');
    notification.innerHTML = code;
    let noti = document.querySelectorAll('.notification-container');

    if(noti.length >=1){
        if(window.innerWidth < 992){
            noti[1].append(notification);
        }
        else {
            noti[0].append(notification);
        }
    } else {
        noti = document.querySelector('.typicms-navbar');
        noti.append(notification);

    }

        

    /*
    noti.forEach(function(n) {
        n.append(notification);
        console.log(n);
    });*/
}