import { PageNotFoundComponent } from './pages/page-not-found/page-not-found.component';
import { AfterLoginService } from './service/guards/after-login.service';
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
import {LuggageFormComponent} from './pages/form/luggage-form/luggage-form.component';
import { OfferViewComponent } from './pages/offerView/offerView.component';
import { OfferConfirmComponent } from './pages/offer-confirm/offer-confirm.component';
import { OfferResultComponent } from './pages/OfferResult/OfferResult.component';

const routes: Routes = [
  // { path: '', component: LoginComponent, canActivate: [BeforeLoginService] },
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  { path: 'home', component: HomePageComponent,  },
  { path: 'login', component: LoginComponent,  },
  { path: 'register', component: RegisterComponent,  },
  { path: 'profile', component: ProfileComponent, canActivate: [AfterLoginService] },
  { path: 'request-password-reset', component: RequestResetComponent,   },
  { path: 'responce-password-reset', component: ResponceResetComponent,   },
  { path: 'trips', component: TripsComponent,   },
  { path: 'tripform/:id', component: TripFormComponent, canActivate: [AfterLoginService]  },
  { path: 'luggages', component: LuggagesComponent,   },
  { path: 'luggageform/:id', component: LuggageFormComponent, canActivate: [AfterLoginService]  },
  { path: 'offerview/:tripId/:luggageId', component: OfferViewComponent, canActivate: [AfterLoginService]  },
  { path: 'offerconfirm/:id', component: OfferConfirmComponent, canActivate: [AfterLoginService]  },
  { path: 'offer-result-from-peer/:id', component: OfferResultComponent, canActivate: [AfterLoginService]  },
  { path: '**', component: PageNotFoundComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
