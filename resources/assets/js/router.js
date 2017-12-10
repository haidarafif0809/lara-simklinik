//DASHBOARD
import DashboardIndex from './components/dashboard/Dashboard.vue';

 // Master Data Poli
 import PoliIndex from './components/poli/PoliIndex.vue'
 import PoliCreate from './components/poli/PoliCreate.vue'
 import PoliEdit from './components/poli/PoliEdit.vue'

// master data supplier

 import SuplierIndex from './components/suplier/SuplierIndex.vue'
 import SuplierCreate from './components/suplier/SuplierCreate.vue'
 import SuplierEdit from './components/suplier/SuplierEdit.vue'

 // master data satuan

 import SatuanIndex from './components/satuan/SatuanIndex.vue'
 import SatuanCreate from './components/satuan/SatuanCreate.vue'
 import SatuanEdit from './components/satuan/SatuanEdit.vue'
 // master data kategori produk

 import KategoriProdukIndex from './components/kategori_produk/KategoriProdukIndex.vue'
 import KategoriProdukCreate from './components/kategori_produk/KategoriProdukCreate.vue'
 import KategoriProdukEdit from './components/kategori_produk/KategoriProdukEdit.vue'

 const routes = [
 {
 	path: '/',
 	components: {
 		dashboardIndex: DashboardIndex
 	},
 	name : 'indexDashboard'
 },
 { path: '/suplier', component: SuplierIndex, name: 'indexSuplier' },
 { path: '/suplier/create', component: SuplierCreate, name: 'createSuplier' },
 { path: '/suplier/:id/edit', component: SuplierEdit, name: 'editSuplier' },
 { path: '/poli', component: PoliIndex, name: 'indexPoli' },
 { path: '/poli/create', component: PoliCreate, name: 'createPoli' },
 { path: '/poli/:id/edit', component: PoliEdit, name: 'editPoli' },
 { path: '/satuan', component: SatuanIndex, name: 'indexSatuan' },
 { path: '/satuan/create', component: SatuanCreate, name: 'createSatuan' },
 { path: '/satuan/:id/edit', component: SatuanEdit, name: 'editSatuan' }
 ,
 { path: '/kategori-produk', component: KategoriProdukIndex, name: 'indexKategoriProduk' },
 { path: '/kategori-produk/create', component: KategoriProdukCreate, name: 'createKategoriProduk' },
 { path: '/kategori-produk/:id/edit', component: KategoriProdukEdit, name: 'editKategoriProduk' }
 ]

 export default routes;