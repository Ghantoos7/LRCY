import { Injectable } from '@angular/core';
import { HttpInterceptor, HttpRequest, HttpHandler, HttpEvent } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable()
export class AuthInterceptor implements HttpInterceptor {
  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    const auth_token = localStorage.getItem('auth_token');
    if (auth_token) {
      request = request.clone({
        setHeaders: {
          Authorization: `Bearer ${auth_token}`
        }
      });
    }
    return next.handle(request);
  }
}
