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
 { path: '/poli/:id/edit', component: PoliEdit, name: 'editPoli' }
 ]

 export default routes;