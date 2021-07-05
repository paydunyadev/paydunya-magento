import { NgModule } from '@angular/core';
import { SoapSharedLibsModule } from './shared-libs.module';
import { AlertComponent } from './alert/alert.component';
import { AlertErrorComponent } from './alert/alert-error.component';
import { HasAnyAuthorityDirective } from './auth/has-any-authority.directive';

@NgModule({
  imports: [SoapSharedLibsModule],
  declarations: [AlertComponent, AlertErrorComponent, HasAnyAuthorityDirective],
  exports: [SoapSharedLibsModule, AlertComponent, AlertErrorComponent, HasAnyAuthorityDirective],
})
export class SoapSharedModule {}
