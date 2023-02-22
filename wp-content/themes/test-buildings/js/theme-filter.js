$(function(){

    class themeFilterQueryBuilder {
        queryArgs = [];
        queryString = '';
        queryArgName = '';

        constructor( queryArgs = [], queryArgName = 'filter' ) {
            this.queryArgs      = queryArgs;
            this.queryArgName   = queryArgName;
        }

        setQuery( queryArgs = [] ) {
            this.queryArgs = queryArgs;
        }

        build() {
            return this.buildQuery();
        }

        buildQuery() {
            let buildedQuery = '';
            if( this.queryArgs ) {
                for (const [key, value] of Object.entries(this.queryArgs)) {
                    if( value && value != '' ) {
                        buildedQuery += `${key}:${value}|`;
                    }
                }
            }
            return buildedQuery != '' ? '?' + this.queryArgName + '=' + buildedQuery : '';
        }
    }

    class themeFilter {
        currentPage = 0;
        filterArgs = [];

        filterObject    = $('#page-filter');
        showMoreObject  = $('#showMoreButton');
        queryBuilder    = new themeFilterQueryBuilder;
        contentId       = $('#theme-filter-1');
        queryArgName    = 'filter';

        getHousingArgs() {
            let resultArgs      = [];
            let housingTerms    = [];
            let housingObjects  = this.filterObject.find('#housing input:checked');
            if( housingObjects.length ) {
                $(housingObjects).each(function(i, el) {
                    housingTerms.push($(el).attr('data-term-id'));
                });
                resultArgs = housingTerms;
            }
            return resultArgs;
        }

        getDeadlineArgs() {
            let resultArgs = [];
            let deadlineObject          = this.filterObject.find('#deadline [name="deadline"]:checked');
            let deadlineSelectedValue   = deadlineObject.length ? deadlineObject.val() : false;
            if( deadlineSelectedValue != null && deadlineSelectedValue != 'all' ) {
                resultArgs = deadlineSelectedValue;
            }
            return resultArgs;
        }

        getServiceArgs() {
            let resultArgs = [];
            let serviceObject = this.filterObject.find('input#service');
            if( serviceObject.length && serviceObject.is(":checked") ) {
                resultArgs.push(true);
            }
            return resultArgs;
        }

        getProximityArgs() {
            const proximities = this.filterObject.find('#proximity input[data-is-proximity=\"1\"]:checked');
            let resultArgs = [];
            if( proximities.length ) {
                let proximitiesArray = [];
                $(proximities).each(function(i, el) {
                    proximitiesArray.push($(el).attr('id'));
                });
                if( !proximitiesArray.includes( 'any' ) ) {
                    resultArgs = proximitiesArray;
                }
            }
            return resultArgs;
        }

        buildFilterArgs() {
            return {
                    proximity   : this.getProximityArgs(),
                    deadline    : this.getDeadlineArgs(),
                    housing     : this.getHousingArgs(),
                    service     : this.getServiceArgs(),
                    page        : [ this.currentPage ],
                };
        }

        buildQueryParams() {
            let buildFilterArgs = this.buildFilterArgs();
            this.queryBuilder.setQuery(buildFilterArgs);
            let buildedQueryString = this.queryBuilder.build();
            return buildedQueryString;
        }

        saveToHistory( buildedQueryString, url, data = null ) {
            if( buildedQueryString != '' ) {
                history.pushState(null, null, window.location.origin + window.location.pathname + buildedQueryString );
            }
        }

        applyFilter( e ) {
            e.preventDefault();
            const filter        = e.data.filter;
            filter.currentPage  = 0;
            filter.sendAjax( filter.buildQueryParams(), filter );
        }

        resetFilter( e ) {
            const filter        = e.data.filter;
            filter.currentPage  = 0;
            filter.sendAjax( filter.buildQueryParams(), filter );
        }

        async showMoreButton( e ) {
            e.preventDefault();
            const filter = e.data.filter;
            filter.currentPage++;
            filter.sendAjax( filter.buildQueryParams(), filter, true );
        }

        async sendAjax( queryString = '', filter, isLoadMore = false ) {
            let data = {
                queryString : queryString ? queryString.replace('?' + filter.queryArgName + '=', '') : '',
                action      : 'theme_filter',
            };

            $.post( themeFilterObject.ajaxUrl, data, function( response ) {
                filter.saveToHistory(queryString, themeFilterObject.ajaxUrl, data);
                filter.renderBuildings( response, isLoadMore, filter );
            } );
        }

        renderBuildings( response, isLoadMore, filter ) {
            if( !response || response == '' ) {
                alert('error');
            }

            if( isLoadMore ) {
                $(filter.contentId).append(response.html);
            } else {
                $(filter.contentId).html(response.html);
            }

            // visibility issue fix
            if( response.html != "" ) {
                filter.contentId.find('.page-loop__item').css('visibility', 'visible');
            }

            // parent() --> div class="show-more"
            if( response.isLastPage || response.html == "" ) {
                filter.showMoreObject.parent().addClass('d-none');
            } else {
                filter.showMoreObject.parent().removeClass('d-none');
            }
        }

        refreshPageState() {
            window.location = location.href;
        }

        constructor() {
            this.filterObject.find('#apply_filter').on('click', { filter: this }, this.applyFilter);
            this.filterObject.find('#reset_filter').on('click', { filter: this }, this.resetFilter);
            this.showMoreObject.on('click', { filter: this }, this.showMoreButton);
            $(window).on('popstate', this.refreshPageState);
        }
    }

    $newThemeFilter1 = new themeFilter();
  
});