Echo.join('market')
    .here(users => {
        console.log(users)
    })
    .joining(user => {
        console.log(user)
    })
    .leaving(user => {
        console.log(user)
    });
    // .listen('OrderShipped', (e) => {
    //     console.log(e.order.name);
    // });