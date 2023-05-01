import { ComponentFixture, TestBed } from '@angular/core/testing';
import { EnvGalleryPage } from './env-gallery.page';

describe('EnvGalleryPage', () => {
  let component: EnvGalleryPage;
  let fixture: ComponentFixture<EnvGalleryPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(EnvGalleryPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
