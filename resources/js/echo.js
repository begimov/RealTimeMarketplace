import { Bus } from './bus'

Echo.join('market')
    .listen('PurchaseRequested', (e) => {
        Bus.$emit('PurchaseRequested', e)
    });
