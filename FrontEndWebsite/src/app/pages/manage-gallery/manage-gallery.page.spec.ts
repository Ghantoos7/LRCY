import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ManageGalleryPage } from './manage-gallery.page';

describe('ManageGalleryPage', () => {
  let component: ManageGalleryPage;
  let fixture: ComponentFixture<ManageGalleryPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(ManageGalleryPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
