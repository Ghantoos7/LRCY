import { ComponentFixture, TestBed } from '@angular/core/testing';
import { HvpGalleryPage } from './hvp-gallery.page';

describe('HvpGalleryPage', () => {
  let component: HvpGalleryPage;
  let fixture: ComponentFixture<HvpGalleryPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(HvpGalleryPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
