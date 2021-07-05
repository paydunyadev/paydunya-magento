/* tslint:disable no-unused-expression */
import { browser, ExpectedConditions as ec, promise } from 'protractor';
import { NavBarPage, SignInPage } from '../../../page-objects/jhi-page-objects';

import { DemandeComponentsPage, DemandeDeleteDialog, DemandeUpdatePage } from './demande.page-object';
import * as path from 'path';

const expect = chai.expect;

describe('Demande e2e test', () => {
  let navBarPage: NavBarPage;
  let signInPage: SignInPage;
  let demandeUpdatePage: DemandeUpdatePage;
  let demandeComponentsPage: DemandeComponentsPage;
  let demandeDeleteDialog: DemandeDeleteDialog;
  const fileNameToUpload = 'logo-jhipster.png';
  const fileToUpload = '../../../../../../../src/main/webapp/content/images/' + fileNameToUpload;
  const absolutePath = path.resolve(__dirname, fileToUpload);

  before(async () => {
    await browser.get('/');
    navBarPage = new NavBarPage();
    signInPage = await navBarPage.getSignInPage();
    await signInPage.loginWithOAuth('admin', 'admin');
    await browser.wait(ec.visibilityOf(navBarPage.entityMenu), 5000);
  });

  it('should load Demandes', async () => {
    await navBarPage.goToEntity('demande');
    demandeComponentsPage = new DemandeComponentsPage();
    await browser.wait(ec.visibilityOf(demandeComponentsPage.title), 5000);
    expect(await demandeComponentsPage.getTitle()).to.eq('gatewayApp.demandeDemande.home.title');
  });

  it('should load create Demande page', async () => {
    await demandeComponentsPage.clickOnCreateButton();
    demandeUpdatePage = new DemandeUpdatePage();
    expect(await demandeUpdatePage.getPageTitle()).to.eq('gatewayApp.demandeDemande.home.createOrEditLabel');
    await demandeUpdatePage.cancel();
  });

  it('should create and save Demandes', async () => {
    const nbButtonsBeforeCreate = await demandeComponentsPage.countDeleteButtons();

    await demandeComponentsPage.clickOnCreateButton();
    await promise.all([
      demandeUpdatePage.setLastNameInput('lastName'),
      demandeUpdatePage.setFirstNameInput('firstName'),
      demandeUpdatePage.setImagePieceInput(absolutePath),
      demandeUpdatePage.userSelectLastOption(),
      demandeUpdatePage.typeSelectLastOption()
    ]);
    expect(await demandeUpdatePage.getLastNameInput()).to.eq('lastName', 'Expected LastName value to be equals to lastName');
    expect(await demandeUpdatePage.getFirstNameInput()).to.eq('firstName', 'Expected FirstName value to be equals to firstName');
    expect(await demandeUpdatePage.getImagePieceInput()).to.endsWith(
      fileNameToUpload,
      'Expected ImagePiece value to be end with ' + fileNameToUpload
    );
    await demandeUpdatePage.save();
    expect(await demandeUpdatePage.getSaveButton().isPresent(), 'Expected save button disappear').to.be.false;

    expect(await demandeComponentsPage.countDeleteButtons()).to.eq(nbButtonsBeforeCreate + 1, 'Expected one more entry in the table');
  });

  it('should delete last Demande', async () => {
    const nbButtonsBeforeDelete = await demandeComponentsPage.countDeleteButtons();
    await demandeComponentsPage.clickOnLastDeleteButton();

    demandeDeleteDialog = new DemandeDeleteDialog();
    expect(await demandeDeleteDialog.getDialogTitle()).to.eq('gatewayApp.demandeDemande.delete.question');
    await demandeDeleteDialog.clickOnConfirmButton();

    expect(await demandeComponentsPage.countDeleteButtons()).to.eq(nbButtonsBeforeDelete - 1);
  });

  after(async () => {
    await navBarPage.autoSignOut();
  });
});
