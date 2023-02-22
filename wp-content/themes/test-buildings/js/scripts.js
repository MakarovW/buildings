"use strict";

function ready(fn) {
  if (document.readyState != 'loading') {
    fn();
    console.log(document.readyState);
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

function outerElementHeight(el) {
  var height = el.offsetHeight;
  var style = getComputedStyle(el);
  height += parseInt(style.marginTop) + parseInt(style.marginBottom);
  return height;
} //Tabs


var tab = function tab() {
  var tabNav = document.querySelectorAll('.tab-nav'),
      tabContent = document.querySelectorAll('.tab-content'),
      tabName;
  [].forEach.call(tabNav, function (item) {
    item.addEventListener('click', selectTabNav);
  });

  function selectTabNav(e) {
    e.preventDefault();
    tabNav.forEach(function (item) {
      item.classList.remove('active');
    });
    this.classList.add('active');
    tabName = this.getAttribute('data-tab-name');
    selectTabContent(tabName);
  }

  function selectTabContent(tab) {
    tabContent.forEach(function (item) {
      var classList = item.classList;
      classList.contains(tab) ? classList.add('tab-content__active') : classList.remove('tab-content__active');
    });
  }
};

var mobileFilter = function mobileFilter() {
  var pageFilter = document.querySelector('.page-filter');
  var pageFilterWrapper = pageFilter.firstElementChild;
  var pageFilterBody = pageFilter.querySelector('.page-filter__body');
  var pageFilterButtons = pageFilter.querySelector('.page-filter__buttons');
  var headerH = document.querySelector('.site-header');
  var navH = document.querySelector('.site-navigation');
  var switchersH = document.querySelector('.page-top__switchers');
  var pagetopH = outerElementHeight(document.querySelector('.page-top')) + 10;
  var pageFilterOffset;

  if (headerH && navH && pagetopH) {
    pageFilterOffset = headerH.offsetHeight + navH.offsetHeight + pagetopH;
  } else {
    pageFilterOffset = pagetopH;
  }

  if (window.innerWidth < 992) {
    pageFilter.classList.add('mobile');
    pageFilterWrapper && pageFilterWrapper.classList.add('container');
    pageFilter.style.top = pageFilterOffset + 'px';
    if (pageFilterBody) pageFilterBody.style.height = window.outerHeight - pageFilterOffset - pageFilterButtons.scrollHeight + 'px';
  } else {
    document.querySelector('.page-top__filter') && document.querySelector('.page-top__filter').classList.remove('active');
    pageFilter.classList.remove('mobile', 'show');
    switchersH && switchersH.classList.remove('fixed');
    pageFilterWrapper && pageFilterWrapper.classList.remove('container');
    document.body.classList.remove('no-scroll');
    pageFilter.style.top = null;
    if (pageFilterBody) pageFilterBody.style.height = null;
  }

  if( switchersH != null ) {
    window.addEventListener('scroll', function () {
      if (window.innerWidth < 992) {
        if (window.pageYOffset > switchersH.offsetTop) {
          switchersH && switchersH.classList.add('fixed');
          pageFilter.style.top = switchersH.offsetHeight + 'px';
          pageFilterBody.style.height = window.outerHeight - switchersH.offsetHeight - pageFilterButtons.scrollHeight + 'px';
        } else {
          switchersH && switchersH.classList.remove('fixed');
          pageFilter.style.top = pageFilterOffset + 'px';
          pageFilterBody.style.height = window.outerHeight - pageFilterOffset - pageFilterButtons.scrollHeight + 'px';
        }
      }
    });
  }

};

var showMobileFilter = function showMobileFilter() {
  var filterTrigger = document.querySelector('.page-top__filter');
  var filterTarget = document.querySelector('.page-filter');
  var filterTargetWrapper = filterTarget.querySelector('.page-filter__wrapper');
  filterTrigger && filterTrigger.addEventListener('click', function (e) {
    e.preventDefault();
    this.classList.toggle('active');
    filterTarget.classList.toggle('show');
    document.body.classList.toggle('no-scroll');
  });
  document.addEventListener('click', function (e) {
    if (filterTrigger) {
      var isClickOutside = filterTrigger.contains(e.target) || filterTargetWrapper.contains(e.target);

      if (!isClickOutside) {
        filterTrigger.classList.remove('active');
        filterTarget.classList.remove('show');
        document.body.classList.remove('no-scroll');
      }
    }
  });
}; //init


function init() {
  console.log('DOMContentLoaded');
  document.querySelector('.wow') && new WOW().init();
  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'));
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl, {
      trigger: 'hover'
    });
  });
  var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'));
  var collapseList = collapseElementList.map(function (collapseEl) {
    return new bootstrap.Collapse(collapseEl, {
      toggle: false
    });
  });
  objectFitImages('img');
  var catCollapse = document.querySelector('.page-filter__category-more');
  catCollapse && catCollapse.addEventListener('click', function () {
    if (!this.previousElementSibling.classList.contains('show')) {
      this.textContent = 'Свернуть';
    } else {
      this.textContent = 'Показать еще (' + this.dataset.count + ')';
    }
  });
  var proximityCheckboxes = document.querySelectorAll('.proximity input');
  var proximityAll = document.getElementById('any');
  [].forEach.call(proximityCheckboxes, function (item) {
    if (proximityAll.checked === true) {
      item.checked = true;
    }

    proximityAll.addEventListener('click', function () {
      if (this !== item) {
        item.checked = true;
      }

      this.checked = true;
    });
    item.addEventListener('click', function () {
      var i;

      if (this !== proximityAll && proximityAll.checked) {
        for (i = 0; i < proximityCheckboxes.length; i++) {
          proximityCheckboxes[i].checked = false;
        }

        this.checked = true;
      } else {
        var checked = [];

        for (i = 0; i < proximityCheckboxes.length - 1; i++) {
          if (proximityCheckboxes[i].checked) {
            checked.push(i);
          }
        }

        if (checked.length === proximityCheckboxes.length - 1) {
          proximityAll.checked = true;
        }
      }
    });
  });
  tab();
  document.querySelector('.page-filter') && mobileFilter();
  document.querySelector('.page-filter') && showMobileFilter();
  window.addEventListener('resize', function () {
    document.querySelector('.page-filter') && mobileFilter();
  });
  var singleMap = document.getElementById('post-map');
  var myMap;
  singleMap && ymaps.ready(function () {
    var center = [55.75399399999374, 37.62209300000001];
    myMap = new ymaps.Map('post-map', {
      center: center,
      zoom: 10,
      controls: []
    }, {
      searchControlProvider: 'yandex#search'
    });
    var appartmentPlacemark = new ymaps.Placemark([55.76288506899503, 37.531872999999884], // myMap.getCenter(),
    {// hintContent: 'ЖК',
      // balloonContent: 'Это красивая метка'
    }, {
      // Опции.
      iconLayout: 'default#image',
      iconImageHref: scriptsMain.homeIconPath + '/img/icons/home.svg',
      iconImageSize: [46, 46],
      iconImageOffset: [-23, -23]
    });
    myMap.geoObjects.add(appartmentPlacemark);
  });
}

ready(init);