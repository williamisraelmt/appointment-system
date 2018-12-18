<template>
    <div>
        <div class="row p-3">
            <div class="col-12">
                <div class="form-group">
                    <input type="text" class="form-control form-control-sm col-12" placeholder="Buscar..." v-model="searchInput"/>
                </div>
            </div>
            <div class="col-12">
                <pagination-component v-if="pagination.lastPage > 1" :pagination="pagination" :offset="5"
                                      @paginate="refreshNetworkData"></pagination-component>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap">
                <thead>
                <tr>
                    <th class="w-1">No.</th>
                    <th>Nombre</th>
                    <th v-if="type !== 'active'">Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(brand, index) in brands" v-if="brands">
                    <td><span class="text-muted" v-text="brand.id ? brand.id.toString().padStart(6, '0') : ''"></span>
                    </td>
                    <td><a class="text-inherit" v-text="brand.name"></a></td>
                    <td v-if="type !== 'active'">
                        <span v-if="brand.status">
                            <span class="status-icon bg-success"></span> Activo
                        </span>
                        <span v-if="!brand.status">
                            <span class="status-icon bg-danger"></span> Inactivo
                        </span>
                    </td>
                    <td class="text-center">
                        <a class="icon" @click="$emit('edit', brand)" v-if="type === 'all'">
                            <i class="fe fe-edit"></i>
                        </a>
                        <a @click="$emit('select', brand)" class="btn btn-secondary btn-sm"  v-if="type === 'active'">Seleccionar</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

    import PaginationComponent from '../../helpers/PaginationComponent';
    import {BrandService} from '../../services/brand.service';
    import {brandModel} from '../../models';
    import _ from 'lodash';

    export default {
        name: "BrandReadComponent",
        components: {
            PaginationComponent
        },
        props: ['type'],
        data() {
            return {
                brands: [brandModel],
                pagination: {'currentPage': 1},
                searchInput: '',
                searchInputIsDirty: false,
                isCalculating: false
            }
        },
        watch: {
            searchInput: function () {
                this.searchInputIsDirty = true;
                this.expensiveOperation()
            }
        },
        mounted: function () {

            this.refreshNetworkData();

        },
        methods: {
            expensiveOperation: _.debounce(function () {
                this.refreshNetworkData();
            }, 500),
            refreshNetworkData() {
                if (this.type === 'all') {
                    this.fetchBrands();
                } else {
                    this.fetchActiveBrands();
                }
            },
            fetchBrands() {

                BrandService.getAll(this.pagination.currentPage, this.searchInput)
                    .then((response) => {

                        this.brands = response.data.data.data;
                        this.pagination = response.data.pagination;

                    }, error => {

                    });

            },
            fetchActiveBrands() {

                BrandService.getActive(this.pagination.currentPage, this.searchInput)
                    .then((response) => {

                        this.brands = response.data.data.data;
                        this.pagination = response.data.pagination;

                    }, error => {

                    });
            },
            onEditClick(index) {
                this.invoice = Object.assign({}, this.brands[index]);
                console.log(this.invoice);
                // this.showCreateForm = true;
            }
        }
    }
</script>

<style scoped>

</style>