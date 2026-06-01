import AuthController from './AuthController'
import DashboardController from './DashboardController'
import CutiController from './CutiController'
import PengajuanCutiController from './PengajuanCutiController'
import KalenderDinasLuarController from './KalenderDinasLuarController'
import UserManagementController from './UserManagementController'
import Admin from './Admin'
import PegawaiController from './PegawaiController'
import DinasLuarController from './DinasLuarController'
import Settings from './Settings'

const Controllers = {
    AuthController: Object.assign(AuthController, AuthController),
    DashboardController: Object.assign(DashboardController, DashboardController),
    CutiController: Object.assign(CutiController, CutiController),
    PengajuanCutiController: Object.assign(PengajuanCutiController, PengajuanCutiController),
    KalenderDinasLuarController: Object.assign(KalenderDinasLuarController, KalenderDinasLuarController),
    UserManagementController: Object.assign(UserManagementController, UserManagementController),
    Admin: Object.assign(Admin, Admin),
    PegawaiController: Object.assign(PegawaiController, PegawaiController),
    DinasLuarController: Object.assign(DinasLuarController, DinasLuarController),
    Settings: Object.assign(Settings, Settings),
}

export default Controllers