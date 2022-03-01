<?php

namespace App\Http\Controllers;

use App\Services\ExpressionEvaluationService;
use App\Exceptions\MalformedExpressionException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class EvaluateDSLController extends Controller
{
    public function evaluate(Request $request, ExpressionEvaluationService $expressionEvaluationService)
    {
        $validator = \Validator::make($request->all(), [
            'security' => 'required|exists:securities,symbol',
            'expression.fn' => ['required',Rule::in(array_keys(config('securities.operators')))],
            'expression.a' => 'required',
            'expression.b' => 'required',
        ]);

        if ($validator->fails()) {
            $response['error'] = $validator->errors();;
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        $securitySymbol = $request->input('security');
        $expression = $request->input('expression');

        try {
            return response()->json([
                'result' => $expressionEvaluationService->evaluate($request->security, $request->expression)
            ]);
        } catch (MalformedExpressionException $e) {
            return response()->json([
                'error' => 'Malformed expression: ' . $e->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());

            return response()->json([
                'error' => 'There was a problem while processing your request'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
