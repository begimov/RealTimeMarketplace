import { Bus } from './bus'

Echo.join('market')
    .here(users => {
        Bus.$emit('users', users);
    })
    .joining(user => {
        Bus.$emit('user-joined', user);
    })
    .leaving(user => {
        Bus.$emit('user-left', user);
    });
    // .listen('OrderShipped', (e) => {
    //     console.log(e.order.name);
    // });