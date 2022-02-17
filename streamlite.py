import streamlit as st
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
from sklearn.preprocessing import StandardScaler
import numpy as np # linear algebra
import os # accessing directory structure



df = pd.read_csv(r'C:\Users\talha\Downloads\programming Project\telecom_churn_data.csv')








st.title("Introduction")
st.subheader("Telecom Churn - ML Group Case Study")
code = '''Problem Statement 
        Reduce churn rate for high value customers 
        The dataset is of Indian and southeast Asian market 
        Churn Phases 
        In good phase the customer is happy with the service and behaves as usual 
        In action phase The customer experience starts to sore in this phase 
        In churn phase the customer is said to have churned '''
st.code(code, language='python')

st.subheader("Result")
st.write("Recommend strategies to manage customer churn")

st.title("Dataset")
st.dataframe(df)


st.title("Random Forest with RFE feature elimination")
st.write(">Accuracy Score for Random Forest Final Model : 0.9320075547161426")

code = '''Observations:
From random forest algorithm, Local Incoming for Month 8, Average Revenue Per Customer for Month 8 and Max Recharge Amount for Month 8 are the most important predictor variables to predict churn.

The results from random forest are very similar to that of the logistic regression and in line to what we had expected from our EDA

Summary : Telecom Churn
Very Less Amount of High Value customers are churning which is a good service indicator
Large no of Customers are new to Telecom Company and fall under < 5 Yr Tenure
Std Outgoing Calls and Revenue Per Customer are strong indicators of Churn
People with less than 4 Yrs of Tenure are more likely to Churn
Behaviour of Volume Based Cost is not a strong indicator of Churn
Max Recharge Amount could be a good Churn Indicator
Random Forest is the best method to Predict Churn, other - models too do a fair job
Behaviour of 8 Month can be the base of Churn Analysis
Local Incoming and Outgoing Calls for 8th Month and Average Revenue in 8th Month are strong indicators of Churn Behaviour '''
st.code(code, language='python')



