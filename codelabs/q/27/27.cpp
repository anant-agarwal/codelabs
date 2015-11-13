#include<iostream>
#include<cstdio>
#include<cstdlib>
#include<algorithm>
#include<cmath>
#include<cstring>
#include<vector>
#include<stack>
#include<queue>
#include<list>
using namespace std;
class PointErasingTwo
{
  public:
  int getMaximum(vector <int> y)
  {
    int max=0;
    for(int i=0;i<y.size();i++)
    {
      int lx=i,ly=y[i];
      for(int j=i+1;j<y.size();j++)
      {
        int rx=j,ry=y[j];
        int count=0;
        for(int k=lx+1;k<rx;k++)
        {
          if((y[k]>ly&&y[k]<ry)||(y[k]<ly&&y[k]>ry))
          count++;
        }
        if(count>max)
        max=count;
      }
    }
     return max;
  }
 
};
main()
{
 PointErasingTwo ob;
 vector<int> v;
 int n;
 cin>>n;
 while(n--)
 {
  int m;
   cin>>m;
  v.push_back(m);
 }
 cout<<ob.getMaximum(v)<<endl;
}			