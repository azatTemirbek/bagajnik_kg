import { PageNotFoundComponent } from './pages/page-not-found/page-not-found.component';
import { AfterLoginService } from './service/guards/after-login.service';
import { BeforeLoginService } from './service/guards/before-login.service';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './pages/auth/login/login.component';
import { RegisterComponent } from './pages/auth/register/register.component';
import { ProfileComponent } from './pages/profile/profile.component';
import { RequestResetComponent } from './pages/auth/password/request-reset/request-reset.component';
import { ResponceResetComponent } from './pages/auth/password/responce-reset/responce-reset.component';
import { HomePageComponent } from './pages/home-page/home-page.component';
import { TripsComponent } from './pages/trips/trips.component';
import { LuggagesComponent } from './pages/luggages/luggages.component';
import { TripFormComponent } from './pages/form/trip-form/trip-form.component';

const routes: Routes = [
  // { path: '', component: LoginComponent, canActivate: [BeforeLoginService] },
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  { path: 'home', component: HomePageComponent, canActivate: [BeforeLoginService] },
  { path: 'login', component: LoginComponent, canActivate: [BeforeLoginService] },
  { path: 'register', component: RegisterComponent, canActivate: [BeforeLoginService] },
  { path: 'profile', component: ProfileComponent, canActivate: [BeforeLoginService] },
  { path: 'request-password-reset', component: RequestResetComponent, canActivate: [BeforeLoginService]  },
  { path: 'response-password-reset', component: ResponceResetComponent, canActivate: [BeforeLoginService]  },
  { path: 'trips', component: TripsComponent, canActivate: [BeforeLoginService]  },
  { path: 'tripform/:id', component: TripFormComponent, canActivate: [BeforeLoginService]  },
  { path: 'luggages', component: LuggagesComponent, canActivate: [BeforeLoginService]  },
  { path: '**', component: PageNotFoundComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
