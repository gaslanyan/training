import texts from '../components/json/registertexts.json';

export function getPromiseResult(credentials) {
    let url = credentials.url;
    delete credentials.url;
    let auth = "";
    if (credentials.auth)
        auth = "auth/";
    delete credentials.auth;

    return new Promise((res, rej) => {
        axios.post('/api/' + auth + url, credentials,
        )
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(err);
            })
    })
}

export function getPaymentDetails(credentials) {
    return new Promise((res, rej) => {
        axios.get('https://servicestest.ameriabank.am/VPOS/api/VPOS/GetPaymentDetails',
            credentials,
            {
                headers: {
                    'Access-Control-Allow-Origin': 'https://www.shmz.am',
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json',
                }
            },
        )
            .then(response => {
                res(response);
            })
            .catch(err => {
                console.log('rej', err)
                rej(texts.error);
            })
    })
}

export function langs(el, lng) {

    let pattern;
    if (lng === 'hy')
        pattern = /^[\u0530-\u058FF|\u0020-\u0040]*$/;
    else
        pattern = /^[\u0000-\u009F]*$/;
    return (!pattern.test(el)) ? false : true;
}

