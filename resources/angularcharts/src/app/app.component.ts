import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { interval } from 'rxjs';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'angularcharts';

  constructor(private http:HttpClient) {}

//Bar Chart
type = 'pie';
         options = {
            responsive: true,
            maintainAspectRatio: true,
        };
        data:any;
        barchart:any;

        
        ngOnInit(){
            //web api call

            this.http.get('http://localhost/chartjs.php').subscribe(data => {
                this.barchart = data;
                this.data = {
                    labels: this.barchart[0], //months
                    datasets: [{
                    label: "Angular 12",
                    data: this.barchart[1][0],
                    backgroundColor: ['yellow','blue','green'],
                    },
                    {
                        label: "Angular 13",
                        data: this.barchart[1][1],
                        backgroundColor: ['yellow','red'],
                    }],
                };
        });
}

}