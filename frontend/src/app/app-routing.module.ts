import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { AfterLoginService } from './service/after-login.service';
import { BeforeLoginService } from './service/before-login.service';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { ProfileComponent } from './components/profile/profile.component';
import { RequestResetComponent } from './components/password/request-reset/request-reset.component';
import { ResponceResetComponent } from './components/password/responce-reset/responce-reset.component';
import { HomePageComponent } from './components/home-page/home-page.component';
import { TripsComponent } from './pages/trips/trips.component';

const routes: Routes = [
  // { path: '', component: LoginComponent, canActivate: [BeforeLoginService] },
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  { path: 'home', component: HomePageComponent, canActivate: [BeforeLoginService] },
  { path: 'login', component: LoginComponent, canActivate: [BeforeLoginService] },
  { path: 'register', component: RegisterComponent, canActivate: [BeforeLoginService] },
  { path: 'profile', component: ProfileComponent, canActivate: [AfterLoginService] },
  { path: 'request-password-reset', component: RequestResetComponent, canActivate: [BeforeLoginService]  },
  { path: 'response-password-reset', component: ResponceResetComponent, canActivate: [BeforeLoginService]  },
  { path: 'trips', component: TripsComponent, canActivate: [BeforeLoginService]  },
  { path: '**', component: PageNotFoundComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
