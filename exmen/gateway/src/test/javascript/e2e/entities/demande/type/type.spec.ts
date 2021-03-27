/* tslint:disable no-unused-expression */
import { browser, ExpectedConditions as ec, promise } from 'protractor';
import { NavBarPage, SignInPage } from '../../../page-objects/jhi-page-objects';

import { TypeComponentsPage, TypeDeleteDialog, TypeUpdatePage } from './type.page-object';

const expect = chai.expect;

describe('Type e2e test', () => {
  let navBarPage: NavBarPage;
  let signInPage: SignInPage;
  let typeUpdatePage: TypeUpdatePage;
  let typeComponentsPage: TypeComponentsPage;
  let typeDeleteDialog: TypeDeleteDialog;

  before(async () => {
    await browser.get('/');
    navBarPage = new NavBarPage();
    signInPage = await navBarPage.getSignInPage();
    await signInPage.loginWithOAuth('admin', 'admin');
    await browser.wait(ec.visibilityOf(navBarPage.entityMenu), 5000);
  });

  it('should load Types', async () => {
    await navBarPage.goToEntity('type');
    typeComponentsPage = new TypeComponentsPage();
    await browser.wait(ec.visibilityOf(typeComponentsPage.title), 5000);
    expect(await typeComponentsPage.getTitle()).to.eq('gatewayApp.demandeType.home.title');
  });

  it('should load create Type page', async () => {
    await typeComponentsPage.clickOnCreateButton();
    typeUpdatePage = new TypeUpdatePage();
    expect(await typeUpdatePage.getPageTitle()).to.eq('gatewayApp.demandeType.home.createOrEditLabel');
    await typeUpdatePage.cancel();
  });

  it('should create and save Types', async () => {
    const nbButtonsBeforeCreate = await typeComponentsPage.countDeleteButtons();

    await typeComponentsPage.clickOnCreateButton();
    await promise.all([typeUpdatePage.setTitleInput('title')]);
    expect(await typeUpdatePage.getTitleInput()).to.eq('title', 'Expected Title value to be equals to title');
    await typeUpdatePage.save();
    expect(await typeUpdatePage.getSaveButton().isPresent(), 'Expected save button disappear').to.be.false;

    expect(await typeComponentsPage.countDeleteButtons()).to.eq(nbButtonsBeforeCreate + 1, 'Expected one more entry in the table');
  });

  it('should delete last Type', async () => {
    const nbButtonsBeforeDelete = await typeComponentsPage.countDeleteButtons();
    await typeComponentsPage.clickOnLastDeleteButton();

    typeDeleteDialog = new TypeDeleteDialog();
    expect(await typeDeleteDialog.getDialogTitle()).to.eq('gatewayApp.demandeType.delete.question');
    await typeDeleteDialog.clickOnConfirmButton();

    expect(await typeComponentsPage.countDeleteButtons()).to.eq(nbButtonsBeforeDelete - 1);
  });

  after(async () => {
    await navBarPage.autoSignOut();
  });
});
