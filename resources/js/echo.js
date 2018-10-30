import { Bus } from './bus'

Echo.join('market')
    .here(users => {
        Bus.$emit('users', users);
    }).listen('PurchaseRequested', (e) => {
        console.log(e);
    });