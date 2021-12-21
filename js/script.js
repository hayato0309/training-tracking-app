/**
 * Trainig schedule用モーダル
 */
const openScheduleModal = document.getElementById('open-schedule-modal');
const scheduleModalContainer = document.getElementById('schedule-modal-container');
const closeScheduleModal = document.getElementById('close-schedule-modal');

// 該当セクションをクリックしたときにモーダルを開く
openScheduleModal.addEventListener('click', () => {
    scheduleModalContainer.classList.add('show');
});

// モーダル以外のグレーの部分をクリックしたときにモーダルを閉じる
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('show') && !e.target.closest('.modal')) {
        // classに'show'を持つ、かつ、モーダルのその側をクリックされた時
        // モーダルの外側をクリックしたときの処理
        scheduleModalContainer.classList.remove('show');
    } else {
        // モーダルの内側をクリックしたときの処理
        return;
    }
})

// xマークをクリックしたときにモーダルを閉じる
closeScheduleModal.addEventListener('click', () => {
    scheduleModalContainer.classList.remove('show');
});

/**
 * Sizes用モーダル
 */
const openSizesModal = document.getElementById('open-sizes-modal');
const sizesModalContainer = document.getElementById('sizes-modal-container');
const closeSizesModal = document.getElementById('close-sizes-modal');

// 該当セクションをクリックしたときにモーダルを開く
openSizesModal.addEventListener('click', () => {
    sizesModalContainer.classList.add('show');
});

// モーダル以外のグレーの部分をクリックしたときにモーダルを閉じる
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('show') && !e.target.closest('.modal')) {
        // classに'show'を持つ、かつ、モーダルのその側をクリックされた時
        // モーダルの外側をクリックしたときの処理
        sizesModalContainer.classList.remove('show');
    } else {
        // モーダルの内側をクリックしたときの処理
        return;
    }
});

// xマークをクリックしたときにモーダルを閉じる
closeSizesModal.addEventListener('click', () => {
    sizesModalContainer.classList.remove('show');
});

/**
 * Cost用モーダル
 */
const openCostModal = document.getElementById('open-cost-modal');
const costModalContainer = document.getElementById('cost-modal-container');
const closeCostModal = document.getElementById('close-cost-modal');

// 該当セクションをクリックしたときにモーダルを開く
openCostModal.addEventListener('click', () => {
    costModalContainer.classList.add('show');
});

// モーダル以外のグレーの部分をクリックしたときにモーダルを閉じる
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('show') && !e.target.closest('.modal')) {
        // classに'show'を持つ、かつ、モーダルのその側をクリックされた時
        // モーダルの外側をクリックしたときの処理
        costModalContainer.classList.remove('show');
    } else {
        // モーダルの内側をクリックしたときの処理
        return;
    }
});

// xマークをクリックしたときにモーダルを閉じる
closeCostModal.addEventListener('click', () => {
    costModalContainer.classList.remove('show');
});
