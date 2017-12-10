//DASHBOARD
import DashboardIndex from './components/dashboard/Dashboard.vue';

 // Master Data Poli
 import PoliIndex from './components/poli/PoliIndex.vue'
 import PoliCreate from './components/poli/PoliCreate.vue'
 import PoliEdit from './components/poli/PoliEdit.vue'

 const routes = [
 {
 	path: '/',
 	components: {
 		dashboardIndex: DashboardIndex
 	},
 	name : 'indexDashboard'
 },
 { path: '/poli', component: PoliIndex, name: 'indexPoli' },
 { path: '/poli/create', component: PoliCreate, name: 'createPoli' },
 { path: '/poli/:id/edit', component: PoliEdit, name: 'editPoli' }
 ]

 export default routes;