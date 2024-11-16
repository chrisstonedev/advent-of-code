VERSION 1.0 CLASS
BEGIN
  MultiUse = -1  'True
  Persistable = 0  'NotPersistable
  DataBindingBehavior = 0  'vbNone
  DataSourceBehavior  = 0  'vbNone
  MTSTransactionMode  = 0  'NotAnMTSObject
END
Attribute VB_Name = "cls2022Day01"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = True
Attribute VB_PredeclaredId = False
Attribute VB_Exposed = True
Option Explicit

Public Function ExecutePartOne(ByRef inputArray() As String) As Long
    Dim caloriesCarriedByEachElf() As Long
    caloriesCarriedByEachElf = GetCaloriesCarriedByEachElf(inputArray)

    Dim Index As Long
    Dim HighestValue As Long
    For Index = LBound(caloriesCarriedByEachElf) To UBound(caloriesCarriedByEachElf)
        If caloriesCarriedByEachElf(Index) > HighestValue Then
            HighestValue = caloriesCarriedByEachElf(Index)
        End If
    Next
    ExecutePartOne = HighestValue
End Function

Public Function ExecutePartTwo(ByRef inputArray() As String) As Long
    Dim caloriesCarriedByEachElf() As Long
    caloriesCarriedByEachElf = GetCaloriesCarriedByEachElf(inputArray)

    Dim Index As Long
    Dim HighestValue As Long
    Dim SecondHighestValue As Long
    Dim ThirdHighestValue As Long
    For Index = LBound(caloriesCarriedByEachElf) To UBound(caloriesCarriedByEachElf)
        If caloriesCarriedByEachElf(Index) > HighestValue Then
            ThirdHighestValue = SecondHighestValue
            SecondHighestValue = HighestValue
            HighestValue = caloriesCarriedByEachElf(Index)
        ElseIf caloriesCarriedByEachElf(Index) > SecondHighestValue Then
            ThirdHighestValue = SecondHighestValue
            SecondHighestValue = caloriesCarriedByEachElf(Index)
        ElseIf caloriesCarriedByEachElf(Index) > ThirdHighestValue Then
            ThirdHighestValue = caloriesCarriedByEachElf(Index)
        End If
    Next
    ExecutePartTwo = HighestValue + SecondHighestValue + ThirdHighestValue
End Function

Private Function GetCaloriesCarriedByEachElf(ByRef inputArray() As String) As Long()
    Dim Result() As Long
    Dim caloriesForCurrentElf As Long
    Dim Index As Integer
    Dim CurrentResultIndex As Long

    For Index = LBound(inputArray) To UBound(inputArray)
        Dim calories As String
        calories = inputArray(Index)
        If calories <> "" Then
            caloriesForCurrentElf = caloriesForCurrentElf + CLng(calories)
        End If
        If calories = "" Or Index = UBound(inputArray) Then
            If CurrentResultIndex = 0 Then
                ReDim Result(0)
            Else
                ReDim Preserve Result(CurrentResultIndex)
            End If
            Result(CurrentResultIndex) = caloriesForCurrentElf
            caloriesForCurrentElf = 0
            CurrentResultIndex = CurrentResultIndex + 1
        End If
    Next
    GetCaloriesCarriedByEachElf = Result
End Function

