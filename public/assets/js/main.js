

(function () {
    "use strict";

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach(e => e.addEventListener(type, listener))
        } else {
            select(el, all).addEventListener(type, listener)
        }
    }

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener)
    }

    /**
     * Sidebar toggle
     */
    if (select('.toggle-sidebar-btn')) {
        on('click', '.toggle-sidebar-btn', function (e) {
            select('body').classList.toggle('toggle-sidebar')
        })
    }

    /**
     * Search bar toggle
     */
    if (select('.search-bar-toggle')) {
        on('click', '.search-bar-toggle', function (e) {
            select('.search-bar').classList.toggle('search-bar-show')
        })
    }

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select('#navbar .scrollto', true)
    const navbarlinksActive = () => {
        let position = window.scrollY + 200
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return
            let section = select(navbarlink.hash)
            if (!section) return
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active')
            } else {
                navbarlink.classList.remove('active')
            }
        })
    }
    window.addEventListener('load', navbarlinksActive)
    onscroll(document, navbarlinksActive)

    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     */
    let selectHeader = select('#header')
    if (selectHeader) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                selectHeader.classList.add('header-scrolled')
            } else {
                selectHeader.classList.remove('header-scrolled')
            }
        }
        window.addEventListener('load', headerScrolled)
        onscroll(document, headerScrolled)
    }

    /**
     * Back to top button
     */
    let backtotop = select('.back-to-top')
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active')
            } else {
                backtotop.classList.remove('active')
            }
        }
        window.addEventListener('load', toggleBacktotop)
        onscroll(document, toggleBacktotop)
    }

    /**
     * Initiate tooltips
     */
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    /**
     * Initiate quill editors
     */
    if (select('.quill-editor-default')) {
        new Quill('.quill-editor-default', {
            theme: 'snow'
        });
    }

    if (select('.quill-editor-bubble')) {
        new Quill('.quill-editor-bubble', {
            theme: 'bubble'
        });
    }

    if (select('.quill-editor-full')) {
        new Quill(".quill-editor-full", {
            modules: {
                toolbar: [
                    [{
                        font: []
                    }, {
                        size: []
                    }],
                    ["bold", "italic", "underline", "strike"],
                    [{
                        color: []
                    },
                    {
                        background: []
                    }
                    ],
                    [{
                        script: "super"
                    },
                    {
                        script: "sub"
                    }
                    ],
                    [{
                        list: "ordered"
                    },
                    {
                        list: "bullet"
                    },
                    {
                        indent: "-1"
                    },
                    {
                        indent: "+1"
                    }
                    ],
                    ["direction", {
                        align: []
                    }],
                    ["link", "image", "video"],
                    ["clean"]
                ]
            },
            theme: "snow"
        });
    }

    /**
     * Initiate TinyMCE Editor
     */

    const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

    tinymce.init({
        selector: 'textarea.tinymce-editor',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
        editimage_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        link_list: [{
            title: 'My page 1',
            value: 'https://www.tiny.cloud'
        },
        {
            title: 'My page 2',
            value: 'http://www.moxiecode.com'
        }
        ],
        image_list: [{
            title: 'My page 1',
            value: 'https://www.tiny.cloud'
        },
        {
            title: 'My page 2',
            value: 'http://www.moxiecode.com'
        }
        ],
        image_class_list: [{
            title: 'None',
            value: ''
        },
        {
            title: 'Some class',
            value: 'class-name'
        }
        ],
        importcss_append: true,
        file_picker_callback: (callback, value, meta) => {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', {
                    text: 'My text'
                });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', {
                    alt: 'My alt text'
                });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                callback('movie.mp4', {
                    source2: 'alt.ogg',
                    poster: 'https://www.google.com/logos/google.jpg'
                });
            }
        },
        height: 600,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        contextmenu: 'link image table',
        skin: useDarkMode ? 'oxide-dark' : 'oxide',
        content_css: useDarkMode ? 'dark' : 'default',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });

    /**
     * Initiate Bootstrap validation check
     */
    var needsValidation = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(needsValidation)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })

    /**
     * Initiate Datatables
     */
    const datatables = select('.datatable', true)
    datatables.forEach(datatable => {
        new simpleDatatables.DataTable(datatable, {
            perPageSelect: [5, 10, 15, ["All", -1]],
            columns: [{
                select: 2,
                sortSequence: ["desc", "asc"]
            },
            {
                select: 3,
                sortSequence: ["desc"]
            },
            {
                select: 4,
                cellClass: "green",
                headerClass: "red"
            }
            ]
        });
    })

    /**
     * Autoresize echart charts
     */
    const mainContainer = select('#main');
    if (mainContainer) {
        setTimeout(() => {
            new ResizeObserver(function () {
                select('.echart', true).forEach(getEchart => {
                    echarts.getInstanceByDom(getEchart).resize();
                })
            }).observe(mainContainer);
        }, 200);
    }

})();
/**
* PHP Email Form Validation - v3.9
* URL: https://bootstrapmade.com/php-email-form/
* Author: BootstrapMade.com
*/
(function () {
    "use strict";

    let forms = document.querySelectorAll('.php-email-form');

    forms.forEach(function (e) {
        e.addEventListener('submit', function (event) {
            event.preventDefault();

            let thisForm = this;

            let action = thisForm.getAttribute('action');
            let recaptcha = thisForm.getAttribute('data-recaptcha-site-key');

            if (!action) {
                displayError(thisForm, 'The form action property is not set!');
                return;
            }
            thisForm.querySelector('.loading').classList.add('d-block');
            thisForm.querySelector('.error-message').classList.remove('d-block');
            thisForm.querySelector('.sent-message').classList.remove('d-block');

            let formData = new FormData(thisForm);

            if (recaptcha) {
                if (typeof grecaptcha !== "undefined") {
                    grecaptcha.ready(function () {
                        try {
                            grecaptcha.execute(recaptcha, { action: 'php_email_form_submit' })
                                .then(token => {
                                    formData.set('recaptcha-response', token);
                                    php_email_form_submit(thisForm, action, formData);
                                })
                        } catch (error) {
                            displayError(thisForm, error);
                        }
                    });
                } else {
                    displayError(thisForm, 'The reCaptcha javascript API url is not loaded!')
                }
            } else {
                php_email_form_submit(thisForm, action, formData);
            }
        });
    });

    function php_email_form_submit(thisForm, action, formData) {
        fetch(action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(response => {
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error(`${response.status} ${response.statusText} ${response.url}`);
                }
            })
            .then(data => {
                thisForm.querySelector('.loading').classList.remove('d-block');
                if (data.trim() == 'OK') {
                    thisForm.querySelector('.sent-message').classList.add('d-block');
                    thisForm.reset();
                } else {
                    throw new Error(data ? data : 'Form submission failed and no error message returned from: ' + action);
                }
            })
            .catch((error) => {
                displayError(thisForm, error);
            });
    }

    function displayError(thisForm, error) {
        thisForm.querySelector('.loading').classList.remove('d-block');
        thisForm.querySelector('.error-message').innerHTML = error;
        thisForm.querySelector('.error-message').classList.add('d-block');
    }

})();







// ---------------------------------------------------
// office table
// ---------------------------------------------------




function printTable(tableId) {
    const table = document.getElementById(tableId).outerHTML;
    const originalContent = document.body.innerHTML;

    document.body.innerHTML = `<table>${table}</table>`;
    window.print();
    document.body.innerHTML = originalContent;
}

// دالة لتحويل جدول محدد إلى PDF
function exportPDF(tableId) {
    const element = document.getElementById(tableId);
    const options = {
        margin: 1,
        filename: `${tableId}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    html2pdf().set(options).from(element).save();
}

// دالة لتحويل جدول محدد إلى Excel
function exportExcel(tableId) {
    const table = document.getElementById(tableId);
    const workbook = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
    XLSX.writeFile(workbook, `${tableId}.xlsx`);
}

// دالة لتحويل جدول محدد إلى PowerPoint
function exportPowerPoint(tableId) {
    const pptx = new PptxGenJS();
    const slide = pptx.addSlide();

    // استخراج بيانات الجدول
    const table = document.getElementById(tableId);
    const rows = [];
    for (let row of table.rows) {
        const cells = [];
        for (let cell of row.cells) {
            cells.push(cell.innerText);
        }
        rows.push(cells);
    }

    // إضافة الجدول إلى الشريحة
    slide.addTable(rows, {
        x: 0.5, y: 1, w: 8.5,
        border: { pt: "1", color: "000000" },
        fill: "FFFFFF",
        fontSize: 12,
        valign: "middle",
        align: "center",
        fontFace: "Arial"
    });

    pptx.writeFile(`${tableId}.pptx`);
}

// دالة لتحويل جدول محدد إلى Word
async function exportWord(tableId) {
    const doc = new docx.Document();

    // استخراج بيانات الجدول
    const table = document.getElementById(tableId);
    const rows = [];
    for (let row of table.rows) {
        const cells = [];
        for (let cell of row.cells) {
            cells.push(cell.innerText);
        }
        rows.push(cells);
    }

    // إضافة بيانات الجدول إلى مستند Word
    const docRows = rows.map(row => {
        return new docx.TableRow({
            children: row.map(cell => {
                return new docx.TableCell({ children: [new docx.Paragraph(cell)] });
            }),
        });
    });

    doc.addSection({
        properties: {},
        children: [
            new docx.Table({
                rows: docRows
            }),
        ],
    });

    const buffer = await docx.Packer.toBlob(doc);
    const link = document.createElement("a");
    link.href = URL.createObjectURL(buffer);
    link.download = `${tableId}.docx`;
    link.click();
}


// ---------------------------------------------------
// office table
// ---------------------------------------------------



// function cropModel(FormId) {
//     const FormId = document.getElementById(FormId);
//     FormId.style.display = 'block';

// };
document.addEventListener('DOMContentLoaded', function () {
    const modelWorkergruop = document.querySelector('.Workergruop-crop');
    const modelFertilizer = document.querySelector('.fertilizer-crop');
    const modelMachineJob = document.querySelector('.MachineJob-crop');
    const fertilizer = document.getElementById('fertilizer');
    const Workergruop = document.getElementById('Workergruop');
    const MachineJob = document.getElementById('MachineJob');


    fertilizer.addEventListener('click', () => {
        if (fertilizer.click) {
            modelFertilizer.style.display = 'block';

        }
    });
    MachineJob.addEventListener('click', () => {
        if (MachineJob.click) {
            modelMachineJob.style.display = 'block';
            ;
        }
    });
    Workergruop.addEventListener('click', () => {
        if (Workergruop.click) {
            modelWorkergruop.style.display = 'block';
        }
    });


});



// دالة لتحويل جدول محدد إلى PDF
function operationCrop(operationId) {
    const element = document.getElementById(operationId);
    const options = {
        margin: 1,
        filename: `${tableId}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    html2pdf().set(options).from(element).save();
}


document.addEventListener('DOMContentLoaded', function () {
    const fromStoreRadio = document.getElementById('from_store');
    const notFromStoreRadio = document.getElementById('not_from_store');
    const storeForm = document.getElementById('storeForm');
    const notStoreForm = document.getElementById('notStoreForm');
    const storeSelect = document.getElementById('storeSelect');
    const priceInput = document.getElementById('price_from_store');
    const quantityInput = document.getElementById('quantity_from_store');
    const quantityError = document.getElementById('quantity_error');

    // Toggle forms based on radio button selection
    fromStoreRadio.addEventListener('change', () => {
        if (fromStoreRadio.checked) {
            storeForm.style.display = 'block';
            notStoreForm.style.display = 'none';
        }
    });

    notFromStoreRadio.addEventListener('change', () => {
        if (notFromStoreRadio.checked) {
            storeForm.style.display = 'none';
            notStoreForm.style.display = 'block';
        }
    });

    // Update price input when a store item is selected
    storeSelect.addEventListener('change', function () {
        const selectedOption = storeSelect.options[storeSelect.selectedIndex];
        priceInput.value = selectedOption.dataset.price || '';
    });

    // Validate quantity before submission
    quantityInput.addEventListener('input', function () {
        const selectedOption = storeSelect.options[storeSelect.selectedIndex];
        const maxQuantity = parseFloat(selectedOption.dataset.quantity || 0);
        const enteredQuantity = parseFloat(quantityInput.value || 0);

        if (enteredQuantity > maxQuantity) {
            quantityError.style.display = 'block';
        } else {
            quantityError.style.display = 'none';
        }
    });
});






// ---------------------------------------------------
// Represent of attends
// ---------------------------------------------------

        // 1. workersAttendance سيتم تعبئته من API
        let workersAttendance = {};

        const today = new Date();
        let currentDate = new Date(today);

        const calendarTitle = document.getElementById('calendarTitle');
        const daysRow = document.getElementById('daysRow');
        const datesRow = document.getElementById('datesRow');
        const workersRow = document.getElementById('workersRow');

        function updateCalendarTitle(date) {
            const monthName = date.toLocaleString('en-US', {
                month: 'long'
            });
            const year = date.getFullYear();
            calendarTitle.textContent = `${monthName} ${year}`;
        }

        function renderWeek(date) {
            daysRow.innerHTML = '';
            datesRow.innerHTML = '';
            workersRow.innerHTML = '';

            const startOfWeek = new Date(date);
            startOfWeek.setDate(startOfWeek.getDate() - ((startOfWeek.getDay() + 6) % 7)); // السبت أول يوم

            updateCalendarTitle(startOfWeek);

            for (let i = 0; i < 7; i++) {
                const day = new Date(startOfWeek);
                day.setDate(startOfWeek.getDate() + i);

                const dayName = day.toLocaleString('en-US', {
                    weekday: 'short'
                });
                const dayDate = day.getDate();
                const month = day.getMonth() + 1;
                const year = day.getFullYear();
                const fullDate = `${year}-${month.toString().padStart(2, '0')}-${dayDate.toString().padStart(2, '0')}`;

                const thDay = document.createElement('th');
                thDay.textContent = dayName;
                daysRow.appendChild(thDay);

                const tdDate = document.createElement('td');
                const smallDate = document.createElement('div');
                smallDate.className = 'date-number';
                smallDate.textContent = dayDate;
                tdDate.appendChild(smallDate);

                if (day.toDateString() === today.toDateString()) {
                    tdDate.classList.add('current-day');
                }
                datesRow.appendChild(tdDate);

                const tdWorkers = document.createElement('td');
                if (workersAttendance[fullDate]) {
                    workersAttendance[fullDate].forEach(worker => {
                        const div = document.createElement('div');
                        div.className = 'worker-name';
                        div.textContent = worker;

                        const optionsDiv = document.createElement('div');
                        optionsDiv.className = 'worker-options';

                        const editBtn = document.createElement('button');
                        editBtn.textContent = 'تعديل';
                        const deleteBtn = document.createElement('button');
                        deleteBtn.textContent = 'حذف';

                        optionsDiv.appendChild(editBtn);
                        optionsDiv.appendChild(deleteBtn);
                        div.appendChild(optionsDiv);

                        tdWorkers.appendChild(div);
                    });
                }
                workersRow.appendChild(tdWorkers);
            }
        }

        // أزرار التنقل

        function fetchAbsentsAndRender() {
            fetch('/attendance/data')
                .then(response => response.json())
                .then(data => {
                    workersAttendance = data;
                    renderWeek(currentDate);
                })
                .catch(err => console.error('فشل تحميل الغيابات:', err));
        }

        document.getElementById('nextWeek').addEventListener('click', () => {
            currentDate.setDate(currentDate.getDate() + 7);
            renderWeek(currentDate);
        });

        document.getElementById('prevWeek').addEventListener('click', () => {
            currentDate.setDate(currentDate.getDate() - 7);
            renderWeek(currentDate);
        });

        document.getElementById('todayBtn').addEventListener('click', () => {
            currentDate = new Date(today);
            renderWeek(currentDate);
        });

        // تشغيل أولي
        fetchAbsentsAndRender();
// ---------------------------------------------------
// Represent of attends
// ---------------------------------------------------





// ---------------------------------------------------
// show image form
// ---------------------------------------------------
$(document).ready(function () {
    $('#image').change(function () {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
            $('#preview').show();
        }
        reader.readAsDataURL(this.files[0]);
    });
});

function previewFile() {
    var fileInput = document.getElementById('updateImage');
    var preview = document.getElementById('image_preview');

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        }

        reader.readAsDataURL(fileInput.files[0]);
    }
}
// ---------------------------------------------------
// show image form
// ---------------------------------------------------
