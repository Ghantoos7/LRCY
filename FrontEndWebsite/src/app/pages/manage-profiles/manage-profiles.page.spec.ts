import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ManageProfilesPage } from './manage-profiles.page';

describe('ManageProfilesPage', () => {
  let component: ManageProfilesPage;
  let fixture: ComponentFixture<ManageProfilesPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(ManageProfilesPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
