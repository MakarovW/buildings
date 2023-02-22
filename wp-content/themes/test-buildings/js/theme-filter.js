$(function(){

    class themeFilterQueryBuilder {
        queryArgs = [];
        queryString = '';
        queryArgName = 'filter';

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

        getProximityArgs() {
            let resultArgs = [];
            const proximityless10     = this.filterObject.find('#proximityless10').length     && this.filterObject.find('#proximityless10').is(":checked") ? true : false;
            const proximityless1020   = this.filterObject.find('#proximityless1020').length   && this.filterObject.find('#proximityless1020').is(":checked") ? true : false;
            const proximityless2040   = this.filterObject.find('#proximityless2040').length   && this.filterObject.find('#proximityless2040').is(":checked") ? true : false;
            const proximitylessover40 = this.filterObject.find('#proximitylessover40').length && this.filterObject.find('#proximitylessover40').is(":checked") ? true : false;
            const proximityany        = this.filterObject.find('#proximityany').length        && this.filterObject.find('#proximityany').is(":checked") ? true : false;
            
            if( proximityless10 ) {
                resultArgs.push('less10');
            }
            if( proximityless1020 ) {
                resultArgs.push('less1020');
            }
            if( proximityless2040 ) {
                resultArgs.push('less2040');
            }
            if( proximitylessover40 ) {
                resultArgs.push('lessover40');
            }

            return proximityany ? [] : resultArgs;
        }

        buildFilterArgs() {
            return {
                    proximity   : this.getProximityArgs(),
                    deadline    : this.getDeadlineArgs(),
                    housing     : this.getHousingArgs(),
                    page        : [ this.currentPage ],
                };
        }

        buildQueryParams() {
            let buildFilterArgs = this.buildFilterArgs();
            this.queryBuilder.setQuery(buildFilterArgs);
            let buildedQueryString = this.queryBuilder.build();
            this.saveToHistory(buildedQueryString);
            return buildedQueryString;
        }

        saveToHistory( buildedQueryString ) {
            if( buildedQueryString != '' ) {
                window.history.pushState(null, null, buildedQueryString );
            }
        }

        applyFilter( e ) {
            e.preventDefault();
            const filter        = e.data.filter;
            filter.currentPage  = 0;
            filter.sendAjax( filter.buildQueryParams(), filter );
            
            //console.log( e );
        }

        resetFilter( e ) {
            const filter        = e.data.filter;
            filter.currentPage  = 0;
            filter.queryString  = '';
            filter.saveToHistory( window.location.origin + window.location.pathname );
            filter.sendAjax( '', filter) ;
            
            //console.log( e );
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

        constructor() {
            this.filterObject.find('#apply_filter').on('click', { filter: this }, this.applyFilter);
            this.filterObject.find('#reset_filter').on('click', { filter: this }, this.resetFilter);
            this.showMoreObject.on('click', { filter: this }, this.showMoreButton);
        }
    }

    $newThemeFilter1 = new themeFilter();
  
});