/*
 * Kode program ini dibuat oleh Zyddv (Zaid Harisah), dan menggunakan notasi penulisan JavaScript terbaru.
 * Sehingga besar kemungkinan tidak kompatibel dengan beberapa web browser lawas.
 */

(() => {

    // Hapus baris 'use strict' untuk keluar dari strict mode.
    'use strict'

    // Kelas dataRequest untuk request data.
    class dataRequest {
        constructor(method = 'GET', url) {
            this.method = method.toUpperCase();
            this.url = url;
            this.contentType = 'application/x-www-form-urlencoded';
        }

        // Method untuk request data.
        async getData(
            params = '',

            //Kirim error jika url belum diisi
            url = this.url || (() => {
                throw new Error('Harap isi url!')
            })(),

            method = this.method
        ) {

            //Cek apakah browser sudah mendukung method fetch.
            if (window.fetch) {
                try {
                    let init = {
                        method: method
                    };
                    if (method === 'POST') {
                        init = {
                            ...init,
                            mode: 'cors',
                            cache: 'no-cache',
                            credentials: 'same-origin',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            redirect: 'error',
                            referrerPolicy: 'no-referrer',
                            body: params
                        }
                    } else if (method === 'GET') {
                        init = {
                            ...init
                        }
                    }
                    let result = await fetch(url, init)
                        .then(r => {
                            if (r.status !== 200) {
                                throw new Error('Respons status mengembalikan angka diluar 200');
                            }
                            return r;
                        })
                        .then(r => r.text())
                        .then(r => r);

                    return await {
                        value: await result,
                        toJson: function () {
                            return JSON.parse(this.value);
                        }
                    }
                } catch (e) {
                    console.error(e);
                    alert('Terjadi kesalahan!');
                }
            }

            // Jika browser belum mendukung method fetch, periksa apakah browser mendukung XMLHttpRequest
            else if (window.XMLHttpRequest) {
                let request = new Promise((success, failed) => {

                    let req = new XMLHttpRequest();
                    req.open(method, url);
                    req.onreadystatechange = () => {
                        if (req.readyState === 4) {
                            if (req.status === 200) {
                                success({
                                    value: req.responseText,
                                    toJson: () => {
                                        return JSON.parse(req.responseText);
                                    }
                                });
                            } else {
                                failed('Galat');
                                console.error(req);
                                alert('Terjadi kesalahan!');
                            }
                        }
                    };
                    if (method === 'POST') {
                        req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        req.send(params);
                    } else if (method === 'GET') {
                        req.send();
                    }
                });

                return request;

            }

            //Jika browser belum mendukung method fetch || XMLHttpRequest maka.
            else {
                alert('Browser anda terlalu lawas');
            }

        }
    }

    async function mulaiPencarianKosakata() {

        // Deklarasi & Inisialisasi variable untuk request data.
        let textBox = document.querySelector('#text-box');
        let searchButton = document.querySelector('#search-button');
        let langToggle = document.querySelector('#lang-toggle');
        let alertContainer = document.querySelector('#alert-container');
        let url = 'http://l1/ksindo/home/kamus/vocabularies';
        let data;
        let langToggleClicked;

        // window.addEventListener('load', (e) => {
        //     searchButton.click();
        // })

        textBox.addEventListener('blur', (e) => {
            textBox.classList.remove('warning');
        });

        // Ketika key enter diklik, maka tombol cari dengan id #search-button juga diklik.
        textBox.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                searchButton.click();
            }
        });

        // Ketika tombol dengan id #search-button diklik, maka request data dilakukan.
        searchButton.addEventListener('click', async (e) => {

            resetMeanContainer();

            if (textBox.value === '') {
                // console.log(langToggleClicked);
                if (!langToggleClicked) {
                    textBox.classList.add('warning');
                    alertContainer
                        .innerHTML = `
                                <div class="alert alert-danger alert-dismissible fade show alert-pencarian" role="alert">
                                    Harap input setidaknya satu karakter!
                                    <button type="button" class="close" id="close-alert-box" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>`;

                    document.querySelector('#close-alert-box')
                        .addEventListener('click', (e) => {
                            textBox.classList.remove('warning');
                        })
                }
                langToggleClicked = false;
            } else {

                alertContainer
                    .innerHTML = '';

                textBox.classList.remove('warning');

                var lang = langToggle.dataset.lang;
                let req = new dataRequest('post', url);

                data = await req.getData(`lang=${lang}&word=${textBox.value}`);
                data = data.toJson();
                let updateUI = await reUI(data);
                // console.log(data);

                if (updateUI) {
                    pencarianArtiKata(lang);
                }
            }

        });

        // Ketika tombol Toggle bahasa diklik, maka lakukan hal berikut.

        langToggle.addEventListener('click', function (e) {
            // console.log(window.getComputedStyle(this));
            // console.log(this.childNodes);

            resetMeanContainer();

            if (this.dataset.lang === 'sunda') {
                this.dataset.lang = 'indonesia';
                this.childNodes[1]
                    .innerHTML = '<span class="font-weight-bold" id="active-lang">Indonesia</span> > Sunda';
            } else {
                this.dataset.lang = 'sunda';
                this.childNodes[1]
                    .innerHTML = '<span class="font-weight-bold" id="active-lang">Sunda </span> > Indonesia';

            }

            langToggleClicked = true;
            searchButton.click();
        })

        // Fungsi untuk reset kontainer arti kata.
        function resetMeanContainer() {
            let wordMeanContainer = document.querySelector('.translation-box');
            wordMeanContainer.innerHTML = '';
        }

    }

    function reUI(data) {
        let vocabularies = '';

        if (data.response !== 'NULL') {

            // let vocabularyList = new Set([]);

            // for (let key in data.response) {
            //     vocabularyList.add(data.response[key]);
            // }

            let vocabularyList = new Set(Object.values(data.response));

            // console.log(vocabularyList);

            vocabularyList = [...vocabularyList].sort();
            // console.log(vocabularyList);

            vocabularyList.forEach((val, key) => {

                vocabularies += `
                                <tr>
                                    <th scope="row">${Number.parseInt(key) + 1}</th>
                                    <td class="vocabulary" data-word="${val}">${val}</td>
                                </tr>`
            });

            // console.log(data.response)
            //     data.response = Array.from(data.response);
            //     data.response.forEach(($val, $key) => {
            //     });
            // console.log(new Map([...data.response]))
            document.querySelector('#vocabularies-container')
                .innerHTML = vocabularies;

            return 'Selesai';
        }

    }



    // Fungsi cari arti kata.
    async function cariArtiKata(kata, lang) {
        let url = 'http://l1/ksindo/home/kamus/mean';
        let req = new dataRequest('post', url);
        let arti = await req.getData(`kata=${kata}&lang=${lang}`);
        arti = arti.toJson();
        // console.log(arti);
        return arti;
    }

    function pencarianArtiKata(lang) {
        let vocabluaryLstNode = document.querySelectorAll('.vocabulary');

        // console.log(vocabluaryLstNode);
        vocabluaryLstNode.forEach((val) => {
            val.addEventListener('click', async (e) => {
                let word = e.target.dataset.word;
                let objekArti = await cariArtiKata(word, lang);
                let wordMeanContainer = document.querySelector('.translation-box');

                if (objekArti.response !== 'NULL') {

                    let artiKata = '';

                    for (let key in objekArti.response) {
                        artiKata += objekArti.response[key];
                        if (key < Object.entries(objekArti.response).length - 1) {
                            artiKata += ', ';
                        } else {
                            artiKata += '.';
                        }
                    }

                    wordMeanContainer.innerHTML = `
                    <div class="container-fluid">
                    <h3 class="mt-4">${word}</h3>
                    <hr>
                    ${artiKata}
                    </div>
                    `

                    // JSON.stringify();
                } else {
                    wordMeanContainer.innerHTML = `
                    <div class="container-fluid">
                    <h3 class="mt-4">${word}</h3>
                    <hr>
                    <p>Hasil tidak ditemukan</p>
                    </div>
                    `;
                }
            })
        });
    }



    if (!/(\/home\/aksara)/.test(location.pathname) && !/(\/home\/bahasa)/.test(location.pathname)) {
        // tampilkanTooltip('#lang-toggle');
        document.querySelector('.setting-button')
            .innerHTML = `

            <!-- Default dropleft button -->
            <div class="btn-group dropleft">
            <!--
              <button href="#" data-toggle="dropdown" aria-expanded="false" class="btn btn-primary" data-toggle="modal" data-target="app-settings-menu">
              ⛭
              </button>
              -->

              <a href="#" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">⛭</a>

              <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">

                  <form>
                  <div class="form-check form-control">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Default checkbox
                  </label>
                </div>
                  </form>
                </div>
                  </div>
                </div>
              </div>
            
            `;
        mulaiPencarianKosakata();
    }

})();