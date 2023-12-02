VERSION 1.0 CLASS
BEGIN
  MultiUse = -1  'True
  Persistable = 0  'NotPersistable
  DataBindingBehavior = 0  'vbNone
  DataSourceBehavior  = 0  'vbNone
  MTSTransactionMode  = 0  'NotAnMTSObject
END
Attribute VB_Name = "clsDay01"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = True
Attribute VB_PredeclaredId = False
Attribute VB_Exposed = True
Option Explicit

Public Function ExecutePartOne(ByRef inputArray() As String) As Long
    Dim Value As Long
    Dim Index As Long
    For Index = LBound(inputArray) To UBound(inputArray)
        Value = Value + GetBasicCalibrationValue(inputArray(Index))
    Next
    ExecutePartOne = Value
End Function

Public Function ExecutePartTwo(ByRef inputArray() As String) As Long
    Dim Value As Long
    Dim Index As Long
    For Index = LBound(inputArray) To UBound(inputArray)
        Value = Value + GetAdvancedCalibrationValue(inputArray(Index))
    Next
    ExecutePartTwo = Value
End Function

Public Function GetBasicCalibrationValue(ByVal Text As String) As Long
    Dim Value As String
    Dim Index As Long
    For Index = 1 To Len(Text)
        If IsNumeric(Mid(Text, Index, 1)) Then
            Value = Mid(Text, Index, 1)
            Exit For
        End If
    Next
    For Index = Len(Text) To 1 Step -1
        If IsNumeric(Mid(Text, Index, 1)) Then
            Value = Value + Mid(Text, Index, 1)
            Exit For
        End If
    Next

    GetBasicCalibrationValue = CLng(Value)
End Function

Public Function GetAdvancedCalibrationValue(ByVal Text As String) As Long
    Dim Value As String
    Dim Index As Long
    Dim NumberWordIndex As Long
    
    Dim NumberWords() As String
    NumberWords = Split("one,two,three,four,five,six,seven,eight,nine", ",")
    
    For Index = 1 To Len(Text)
        If IsNumeric(Mid(Text, Index, 1)) Then
            Value = Mid(Text, Index, 1)
            Exit For
        End If
        For NumberWordIndex = 0 To UBound(NumberWords)
            If InStr(Index, Text, NumberWords(NumberWordIndex)) = Index Then
                Value = CStr(NumberWordIndex + 1)
                Exit For
            End If
        Next
        If Len(Value) > 0 Then
            Exit For
        End If
    Next
    For Index = Len(Text) To 1 Step -1
        If IsNumeric(Mid(Text, Index, 1)) Then
            Value = Value + Mid(Text, Index, 1)
            Exit For
        End If
        For NumberWordIndex = UBound(NumberWords) To 0 Step -1
            If InStr(Index, Text, NumberWords(NumberWordIndex)) = Index Then
                Value = Value + CStr(NumberWordIndex + 1)
                Exit For
            End If
        Next
        If Len(Value) > 1 Then
            Exit For
        End If
    Next

    GetAdvancedCalibrationValue = CLng(Value)
End Function
